<?php

namespace App\Http\Controllers;

use Alert;
use App\Common\ApplicationStatus;
use App\Models\Configurations\Country;
use App\Models\Configurations\Website;
use App\Models\User;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['checkEmail', 'checkWriter']]);
    }

    /**
     * See the user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.profile.index', [
            'user' => Auth::user(),
            'countries' => Country::all(),
            'timezones' => DateTimeZone::listIdentifiers(DateTimeZone::ALL),
        ]);
    }

    /**
     * Update user details.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, $this->rules());

        $user = Auth::user();

        $user->update([
            'phone_number' => $request->phoneNumber,
            'country_code' => $request->countryCode,
            'timezone' => $request->timezone,
        ]);

        //if ($request->hasFile('avatar')) {
        //    $this->uploadAvatar($user);
        //}

        Alert::success(__('alert.success'), __('profile.upload'));

        return redirect()->back();
    }

    /**
     * Validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'timezone' => 'required|max:255',
            'phoneNumber' => 'required|max:255',
            'countryCode' => 'required|max:255',
        ];
    }

    /**
     * Show update password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        return view('app.profile.settings');
    }

    /**
     * Update the user password.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required:confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password did not match.']);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        Alert::success(__('alert.success'), __('profile.password_updated'));

        return redirect()->back();
    }

    /**
     * Check if email exists.
     *
     * @param Request $request
     * @return string
     */
    public function checkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required']);
        $website = Website::whereName(config('app.name'))->first();
        $user = User::whereEmail($request->email)->whereWebsiteId($website->id)->first();
        if (is_null($user)) {
            return 'true';
        }

        return 'false';
    }

    /**
     * Check the entered ID is a valid writer.
     *
     * @param Request $request
     * @return string
     */
    public function checkWriter(Request $request)
    {
        if (!$request->filled('writer_id')) {
            return "true";
        }

        $user = User::whereHas('application', function ($query) {
            $query->whereStatus(ApplicationStatus::APPROVED);
        })
            ->whereId($request->writer_id)
            ->whereStatus(User::ACTIVATED)
            ->first();

        if (is_null($user)) {
            return "false";
        }

        return 'true';
    }

    /**
     * Upload the avatar.
     *
     * @param User $user
     * @return void
     */
    protected function uploadAvatar(User $user)
    {
        if ($user->hasMedia('avatars')) {
            $user->clearMediaCollection('avatars');
        }
        $user->addMediaFromRequest('avatar')
            ->toMediaCollection('avatars', 'avatars');
    }
}
