<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\UserDeactivatedException;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            array_merge([
                'website_id' => websiteId(),
            ], $this->credentials($request)), $request->filled('remember')
        );
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     * @throws ValidationException
     * @throws \Exception
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->status == User::DEACTIVATED) {
            Auth::logout();
            throw new UserDeactivatedException();
        }

        if (!is_null($user->validation_code)) {
            Auth::logout();
            return $this->sendValidateEmailResponse($request);
        }
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return JsonResponse|\Illuminate\Http\Response
     * @throws ValidationException
     * @throws \Exception
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($request->ajax() || $request->wantsJson()) {
            return $this->authenticated($request, $this->guard()->user())
                ?: new JsonResponse(['success' => true, 'message' => 'Login was successful.']);
        }

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }


    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @throws ValidationException
     */
    protected function sendValidateEmailResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.validate_email')],
        ]);
    }
}
