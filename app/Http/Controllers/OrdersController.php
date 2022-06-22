<?php

namespace App\Http\Controllers;

use Alert;
use App\Common\OrderStatus;
use App\Events\Orders\NewFilesAdded;
use App\Events\Orders\OrderAccepted;
use App\Events\Orders\OrderCompleted;
use App\Events\Orders\OrderDisputed;
use App\Events\Orders\OrderReviewed;
use App\Http\Requests\StoreOrder;
use App\Mail\Register\WelcomeEmail;
use App\Models\Configurations\AcademicLevel;
use App\Models\Configurations\Citation;
use App\Models\Configurations\Deadline;
use App\Models\Configurations\Department;
use App\Models\Configurations\Discipline;
use App\Models\Configurations\PaperType;
use App\Models\Configurations\PaymentMethod;
use App\Models\Finance\Transaction;
use App\Models\Finance\Wallet;
use App\Models\OrderPricing;
use App\Models\Orders\Order;
use App\Models\Orders\OrderActivityLog;
use App\Models\User;
use App\Notifications\Remote\NotifyEmployee;
use App\Payments\PaymentGateway;
use App\Rating\Rater;
use App\Traits\Orders\Calculator;
use App\Traits\Orders\OrdersDataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\Models\Media;
use App\Events\Orders\OrderPlaced;

class OrdersController extends Controller
{
    use Calculator, OrdersDataTables;

    /**
     * Show the order form wizard.
     *
     * @param string $level
     * @return \Illuminate\Http\Response
     */
    public function index($level = null)
    {
        return view('orders.order', [
            'paperTypes' => PaperType::all(['id', 'name']),
            'disciplines' => Discipline::all(['id', 'name', 'is_technical']),
            'citations' => Citation::all(['id', 'name']),
            'academicLevels' => AcademicLevel::all(),
            'deadlines' => Deadline::orderDeadlines(),
            'selectedLevel' => is_null($level) ? '' : $level,
            'relatedOrders' => Auth::check() ? Auth::user()->orders : [],
            'pricing' => $this->getPrices(),
            'spacing' => ['double  ', 'single '],
            'status' => new OrderStatus(),
        ]);
    }

    /**
     * Get the prices for the various levels.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getPrices()
    {
        return collect([
            'prices' => OrderPricing::all(),
        ]);
    }

    /**
     * Show order details.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('app.orders.show', [
            'order' => $order = Order::findOrFail($id),
            'status' => new OrderStatus(),
            'department' => $order->employee->employeeProfile->department ?? new Department(),
            'reviewDeadlines' => Deadline::orderReviewDeadlines(),
        ]);
    }

    /**
     * Store the order.
     *
     * @param StoreOrder $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(StoreOrder $request)
    {
        $user = $this->getOrCreateUser($request);

        if (!$user instanceof User) {
            return redirect()->back()->withInput()->withErrors(['unauthenticated' => trans('auth.failed')]);
        }

        $order = $this->createOrder($request, $user);
        $this->setDeadlines($request, $order);

        if ($request->filled('writer_id')) {
            $this->assignWriter($request->writer_id, $order);
        }

        if ($request->hasFile('files')) {
            $this->uploadFiles($order, $request);
        }

        event(new OrderPlaced($order));

        OrderActivityLog::record($order, 'Placed order');

        return $this->makePayment($order, $request->payment_method);
    }

    public function enquiry(StoreOrder $request)
    {
        $user = $this->getOrCreateUser($request);

        if (!$user instanceof User) {
            return redirect()->back()->withInput()->withErrors(['unauthenticated' => trans('auth.failed')]);
        }

        $order = $this->createOrder($request, $user);
        $this->setDeadlines($request, $order);

        if ($request->filled('writer_id')) {
            $this->assignWriter($request->writer_id, $order);
        }

        if ($request->hasFile('files')) {
            $this->uploadFiles($order, $request);
        }

        OrderActivityLog::record($order, 'Placed enquiry');

        event(new OrderPlaced($order));

        return redirect()->route('orders.show', ['id' => $order->id]);
    }

    /**
     * Get the authenticated user or create a user.
     *
     * @param StoreOrder $request
     * @return User
     */
    protected function getOrCreateUser(StoreOrder $request)
    {
        if (Auth::check()) {
            return Auth::user();
        }

        if ($request->filled('login_email') && $request->filled('login_password')) {

            return $this->loginUser($request->login_email, $request->login_password);
        }

        return $this->createUser($request);
    }

    /**
     * Authenticate a user.
     *
     * @param $username
     * @param $password
     * @return \App\Models\User|bool|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected function loginUser($username, $password)
    {
        $authenticated = Auth::attempt([
            'email' => $username,
            'password' => $password,
        ]);

        if ($authenticated) {
            return Auth::user();
        }

        return false;
    }

    /**
     * Create the user from the request and sign them in.
     *
     * @param StoreOrder $request
     * @return User
     */
    protected function createUser(StoreOrder $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'timezone' => $request->timezone,
            'password' => bcrypt($request->password),
        ]);

        $user->acceptEmail();

        $user->wallet()->save(new Wallet());

        Auth::login($user, true);

        Mail::to($user)->send(new WelcomeEmail($user));

        return $user;
    }

    /**
     * Create the order from the request.
     *
     * @param StoreOrder $request
     * @param User $user
     * @return Order
     */
    protected function createOrder(StoreOrder $request, User $user)
    {
        return Order::create($this->orderDetails($request, $user));
    }

    /**
     * Details of an order.
     *
     * @param Request $request
     * @param User $user
     * @return array
     */
    protected function orderDetails(Request $request, User $user)
    {
        return [
            'topic' => $request->topic,
            'client_id' => $user->id,
            'instructions' => $request->instructions,
            'sources' => $request->sources ? $request->sources : 0,
            'pages' => $request->pages,
            'deadline_id' => $request->deadline_id,
            'spacing' => $request->spacing,
            'citation_id' => $request->citation_id == 'other' ? $request->other_citation : $request->citation_id,
            'academic_level_id' => $request->academic_level_id,
            'discipline_id' => $request->discipline_id,
            'paper_type_id' => $request->paper_type_id,
            'related_orders' => $request->related_orders,
            'amount' => $this->calculate($request),
            'payment_method' => $request->payment_method,
            'requires_digital_references' => $request->filled('requires_digital_references') ? 1 : 0,
            'requires_enl_writer' => $request->requires_enl_writer,
            'grammar_report' => $request->filled('grammar'),
            'plagiarism_report' => $request->filled('plagiarism'),
            'charts' => $request->charts,
            'ppt_slides' => $request->ppt_slides,
            'has_speaker_notes' => $request->speakerNote,
        ];
    }

    /**
     * Set deadlines for the order and the writer.
     *
     * @param StoreOrder $request
     * @param Order $order
     * @return void
     */
    protected function setDeadlines(StoreOrder $request, Order $order)
    {
        $deadline = Deadline::find($request->deadline_id);

        $now = Carbon::now();

        if ($deadline->type == 'days') {
            $order->setDeadlineDate($now->copy()->addDays($deadline->value));
            $order->setWriterDeadline($now->copy()->addDays($deadline->writer_deadline));
        }
        if ($deadline->type == 'hours') {
            $order->setDeadlineDate($now->copy()->addHours($deadline->value));
            $order->setWriterDeadline($now->copy()->addHours($deadline->writer_deadline));
        }
    }

    /**
     * Assign writer to the order.
     *
     * @param int $writerId
     * @param Order $order
     * @return bool
     */
    protected function assignWriter($writerId, Order $order)
    {
        $writer = User::find($writerId);

        if (is_null($writer)) {
            return false;
        }

        if ($writer->userType->name != "Writer") {
            return false;
        }

        if ($order->discipline->is_technical && $writer->writerProfile->writer_type == "TECHNICAL") {
            $order->assignWriter($writerId);

            $order->writer_amount = $this->getWriterPrice($order);
            $order->save();

            OrderActivityLog::record($order, 'Assign writer ID '.$writerId.' directly');
        }
        if (!$order->discipline->is_technical && $writer->writerProfile->writer_type == "GENERAL") {
            $order->assignWriter($writerId);

            $order->writer_amount = $this->getWriterPrice($order);
            $order->save();

            OrderActivityLog::record($order, 'Assign writer ID '.$writerId.' directly');
        }

        return false;
    }

    /**
     * Get the set writer price for the order.
     *
     * @param Order $order
     * @return float|int
     */
    protected function getWriterPrice($order)
    {
        if ($order->writer->writerProfile->writerLevel->payment == 'PERCENTAGE') {
            return round($order->amount * ($order->writer->writerProfile->writerLevel->value->percentage / 100), 2);
        }

        $amount = $order->ppt_slides * $order->writer->writerProfile->writerLevel->value->ppt;

        if ($order->spacing == 'single') {
            return round($amount + $order->pages * 2 * $order->writer->writerProfile->writerLevel->value->pages, 2);
        }

        return round($amount + $order->pages * $order->writer->writerProfile->writerLevel->value->pages, 2);
    }

    /**
     * Upload any files that maybe on the request.
     *
     * @param Order $order
     * @param Request $request
     * @return void
     * @internal param array $type
     */
    protected function uploadFiles(Order $order, Request $request)
    {
        $order->addMultipleMediaFromRequest(['files'])->each(function ($fileAdder) use ($request) {
            $mediaItem = $fileAdder->toMediaCollection('orders', 'orders');

            $lastDot = strrpos($mediaItem->file_name, '.') + 1;
            $extension = substr($mediaItem->file_name, $lastDot);

            parse_str($mediaItem->name.' '.$extension, $sanitized);

            $mediaItem->setCustomProperty('order_files', $request->filled(key($sanitized)) ? $request->get(key($sanitized)) : "Order File");

            $mediaItem->setCustomProperty('uploader', 'Client');
            $mediaItem->setCustomProperty('target', 'All');
            $mediaItem->save();
        });
    }

    /**
     * Make payment for the order.
     *
     * @param \App\Models\Orders\Order $order
     * @param string $paymentMethod
     * @return \Illuminate\Http\Response
     */
    protected function makePayment(Order $order, string $paymentMethod)
    {
        if ($transaction = $this->createTransaction($order, $paymentMethod)) {
            $gateWay = new PaymentGateway($paymentMethod);

            return $gateWay->makePayment($transaction, $order->topic);
        }

        Alert::error(__('alert.failed'), __('transaction.failed'));

        return redirect(route('orders.pending'));
    }

    /**
     * Generate a new transaction.
     *
     * @param Order $order
     * @param string $paymentMethod
     * @return \App\Models\Finance\Transaction|bool
     */
    protected function createTransaction(Order $order, string $paymentMethod)
    {
        $paymentMethod = PaymentMethod::whereCode($paymentMethod)->first();
        if (is_null($paymentMethod)) {
            return false;
        }

        return Transaction::create([
            'type' => 'c',
            'attachable_id' => $order->id,
            'attachable_type' => Order::class,
            'description' => 'Order #'.$order->id,
            'reference' => 'ORD'.Carbon::now()->timestamp,
            'payment_method_id' => $paymentMethod->id,
            'amount' => $order->amount,
        ]);
    }

    /**
     * Show the make payment form.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('orders.payment', [
            'order' => Order::findOrFail($id),
            'paperTypes' => PaperType::all(['id', 'name']),
            'disciplines' => Discipline::all(['id', 'name', 'is_technical']),
            'citations' => Citation::all(['id', 'name']),
            'academicLevels' => AcademicLevel::all(),
            'deadlines' => Deadline::orderDeadlines(),
            'selectedLevel' => '',
            'relatedOrders' => Auth::check() ? Auth::user()->orders : [],
            'pricing' => $this->getPrices(),
            'spacing' => ['double', 'single'],
        ]);
    }

    /**
     * Complete payment for the pending order.
     *
     * @param StoreOrder $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function complete(StoreOrder $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($this->orderDetails($request, Auth::user()));

        $this->setDeadlines($request, $order);

        if ($request->filled('writer_id') && User::find($request->writer_id)->userType->name == "Writer") {
            $order->assignWriter($request->writer_id);
        }

        if ($request->hasFile('files')) {
            $this->uploadFiles($order, $request);
        }

        return $this->makePayment($order, $request->payment_method);
    }

    /**
     * Accept a submitted order.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($request->filled('rating') && Rater::doesNotHaveClientMarkFor($order)) {
            Rater::create($order, $request->rating, $request->comments);
        }

        $order->status = OrderStatus::ACCEPTED;
        $order->accepted_at = today();
        $order->save();

        OrderActivityLog::record($order, 'Accepted the order');

        event(new OrderAccepted($order));

        Alert::success(__('alert.success'), __('order.accept'));

        return redirect()->back();
    }

    /**
     * Send an order for review with instructions.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function review(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $this->adjustDeadlinesOnRevision($order, $request);

        $order->comments()->create([
            'user_id' => Auth::user()->id,
            'type' => 'REVISION',
            'subject' => $request->subject,
            'comments' => $request->comments,
        ]);

        $afterAcceptance = false;

        if ($order->status == OrderStatus::ACCEPTED || $order->status == OrderStatus::AUTO_ACCEPTED ||
            $order->status == OrderStatus::MANUALLY_ACCEPTED
        ) {
            $afterAcceptance = true;
        }

        $order->status = OrderStatus::PENDING_CLIENT_REVIEW_CONFIRMATION;
        $order->save();

        OrderActivityLog::record($order, 'Requested order to be reviewed');

        event(new OrderReviewed($order, $afterAcceptance));

        Alert::success(__('alert.success'), __('order.review'));

        return redirect()->back();
    }

    /**
     * Adjust order deadline and writer deadline on revision.
     *
     * @param Order $order
     * @param Request $request
     * @return bool
     */
    protected function adjustDeadlinesOnRevision(Order $order, Request $request)
    {
        $deadline = Deadline::find($request->deadline);
        $order->deadline_date = $this->getFutureDate(now(), $deadline->type, $deadline->value);
        $order->writer_deadline = $this->getFutureDate(now(), $deadline->type, $deadline->writer_deadline);

        return $order->save();
    }

    /**
     * Adjust a deadline according to time added. $timeToAdd string must be
     * in the format {int}_{period}, period can be 'hours' or 'days'.
     *
     * @param Carbon|string $date
     * @param string $type
     * @param int $value
     * @return Carbon
     * @throws \Exception
     */
    protected function getFutureDate($date, $type, $value)
    {
        if (!$date instanceof Carbon) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
        }

        if ($type == 'hours') {
            return $date->copy()->addHours($value);
        }

        if ($type == 'days') {
            return $date->copy()->addDays($value);
        }

        throw new \Exception(__('order.invalid_deadline'));
    }

    /**
     * Send an order for dispute resolution.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function dispute(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->comments()->create([
            'type' => 'DISPUTE',
            'subject' => 'Dispute',
            'user_id' => Auth::user()->id,
            'comments' => $request->comments,
        ]);

        $afterAcceptance = false;

        if ($order->status == OrderStatus::ACCEPTED || $order->status == OrderStatus::AUTO_ACCEPTED
            || $order->status == OrderStatus::MANUALLY_ACCEPTED
        ) {
            $afterAcceptance = true;
        }

        $order->status = OrderStatus::DISPUTED;
        $order->save();

        OrderActivityLog::record($order, 'Disputed the Order');

        event(new OrderDisputed($order, $afterAcceptance));

        Alert::success(__('alert.success'), __('order.disputed'));

        return redirect()->back();
    }

    /**
     * Add new files for the order.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addNewFiles(Request $request, $id)
    {
        $this->validate($request, ['files' => 'required']);

        $order = Order::with('writer', 'employee')->findOrFail($id);

        $this->uploadFiles($order, $request);

        OrderActivityLog::record($order, 'uploaded new files for the order');

        event(new NewFilesAdded($order));

        Alert::success(__('alert.success'), __('order.upload_success'));

        return redirect()->back();
    }

    /**
     * Download the media file.
     *
     * @param Media $mediaItem
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Media $mediaItem)
    {
        return response()->download($mediaItem->getPath(), "#".$mediaItem->model->id."_".$mediaItem->file_name);
    }
}
