<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\User;
use App\Common\MessageFlag;
use App\Models\Orders\Order;
use Illuminate\Http\Request;
use App\Messenger\Messenger;
use App\Common\MessageStates;
use App\Models\Messages\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\Models\Media;
use App\Models\Configurations\Department;
use Spatie\MediaLibrary\FileAdder\FileAdder;

class MessagesController extends Controller
{
    /**
     * MessagesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * View the user's messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.messages.index', [
            'messages' => Messenger::userMessages()->paginate(10),
            'departments' => Department::canReceiveMessages()->get(),
            'messageStates' => new MessageStates(),
            'messageFlag' => new MessageFlag(),
            'sendWriter' => false,

            'user' => Auth::user(),
        ]);
    }

    /**
     * Create a new message.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'recipient' => 'required',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);

        $recipient = $this->getRecipient($request);

        $message = Messenger::send($recipient->id, $request->subject, $request->message, $request->order_id);

        if ($request->hasFile('files')) {
            $this->uploadFiles($message);
        }

        Alert::success(__('alert.success'), __('message.success'));

        return redirect()->back();
    }

    /**
     * Get the recipient of the message.
     *
     * @param Request $request
     * @return User
     */
    protected function getRecipient(Request $request)
    {
        if ($request->filled('order_id')) {
            return $this->getRecipientFromOrder($request);
        }

        return $this->getRecipientFromDepartment($request);
    }

    /**
     * When the order id is specified try and get the recipient from
     * the order.
     *
     * @param Request $request
     * @return mixed
     */
    protected function getRecipientFromOrder(Request $request)
    {
        $order = Order::find($request->order_id);

        if (is_null($order)) {
            return false;
        }

        if ($request->recipient == 'WRITER') {
            return $order->writer;
        }

        // The employee department is the same as the recipient department
        if ($order->employee->department_id == $request->recipient) {
            return $order->employee;
        }

        return $this->getRecipientFromDepartment($request);
    }

    /**
     * Get a user to receive the message when the user selects a department.
     *
     * @param Request $request
     * @return mixed
     */
    protected function getRecipientFromDepartment(Request $request)
    {
        $department = Department::find($request->recipient);

        if (is_null($department)) {
            return $this->getAdministrator();
        }

        $users = User::withPermission('Receive Queries', $department->id)->inRandomOrder()->get();
        if ($users->count()) {
            return $users->first();
        }

        return $this->getAdministrator();
    }

    /**
     * Get a random administrator.
     *
     * @return mixed
     */
    protected function getAdministrator()
    {
        $administrators = User::administrators()->inRandomOrder()->get();

        return $administrators->first();
    }

    /**
     * Upload any files related to the message.
     *
     * @param \App\Models\Messages\Message $message
     * @return mixed
     */
    protected function uploadFiles(Message $message)
    {
        return $message->addMultipleMediaFromRequest(['files'])->each(function (FileAdder $fileAdder) {
            $mediaItem = $fileAdder->toMediaCollection('messages', 'messages');
            $mediaItem->save();
        });
    }

    /**
     * Reply to a message
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function replyMessage(Request $request)
    {
        $this->validate($request, ['message' => 'required']);

        $message = Messenger::reply($request);

        if ($request->hasFile('files')) {
            $this->uploadFiles($message);
        }

        Alert::success(__('alert.success'), __('message.success'));

        return redirect()->back();
    }

    /**
     * Update status message to read.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function doRead(Request $request)
    {
        $this->validate($request, ['message_id' => 'required']);

        Messenger::read($request->message_id);

        return new JsonResponse(["count" => Auth::user()->unreadMessages->count()]);
    }

    /**
     * Download the media file.
     *
     * @param Media $mediaItem
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Media $mediaItem)
    {
        return response()->download($mediaItem->getPath(), $mediaItem->file_name);
    }
}
