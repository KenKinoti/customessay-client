<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ForgotPasswordController extends Controller
{
    /**
     * Constant representing the user not found response.
     *
     * @var string
     */
    const INVALID_USER = 'passwords.user';

    /**
     * Constant representing the user not activated response.
     *
     * @var string
     */
    const DEACTIVATED_USER = 'passwords.deactivated';

    /**
     * Constant representing the user not activated response.
     *
     * @var string
     */
    const INVALID_EMAIL = 'passwords.invalid_email';

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user = User::query()
            ->where('email', $request->input('email'))
            ->where('website_id', websiteId())
            ->first();

        // The email doesn't exist
        if (is_null($user)) {
            return $this->sendResetLinkFailedResponse($request, self::INVALID_USER);
        }

        // When the account is suspended
        if ($user->status == User::DEACTIVATED) {
            return $this->sendResetLinkFailedResponse($request, self::DEACTIVATED_USER);
        }

        // When the account is not activated
        if (!is_null($user->activation_code)) {
            return $this->sendResetLinkFailedResponse($request, self::INVALID_EMAIL);
        }


        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            array_merge([
            ], $request->only('email'))
        );

        return $this->sendResetLinkResponse($response);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param string $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse($response)
    {
        Alert::success(__('alert.success'), trans($response));

        return back();
    }
}
