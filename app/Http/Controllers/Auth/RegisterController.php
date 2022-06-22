<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\ValidRecaptcha;
use App\Models\Finance\Wallet;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Session::put(['complete' => true]);

        return redirect(route('complete'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->where(function ($query) {
                    $query->where('website_id', websiteId());
                }),
            ],
            'password' => 'required|string|min:8|confirmed',
        ];

        if (App::environment('production')) {
            $rules['captcha'] = ['required', new ValidRecaptcha];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'timezone' => $data['timezone'],
            'password' => bcrypt($data['password']),
        ]);

        $user->wallet()->save(new Wallet());

        return $user;
    }

    /**
     * Show the complete page after registration.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete()
    {
        if (Session::has('complete')) {
            Session::remove('complete');

            return view('auth.complete');
        }

        return redirect('/');
    }

    /**
     * Confirm the account from email link
     *
     * @param $code
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirm($code)
    {
        $user = User::whereValidationCode($code)->firstOrFail();
        $user->acceptEmail();

        Alert::success(__('alert.success'),'Your account has been confirmed successfully');

        return redirect(route('login'));
    }
}
