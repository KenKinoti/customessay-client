<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\NewsLetters\NewsLetterSignUp;
use Illuminate\Http\Request;

class NewsLetterSignUpController extends Controller
{
    /**
     * Sign up the details for the newsletter.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function signUp(Request $request)
    {
        $this->validate($request, $this->rules());

        if (NewsLetterSignUp::whereEmail($request->email)->exists()) {
            Alert::warning(__('alert.heads_up'), __('newsletter.exists'));

            return redirect(route('home'));
        }

        NewsLetterSignUp::create([
            'name' => $request->name,
            'email' => $request->email
        ]);

        Alert::success(__('alert.success'), __('newsletter.thanks'));

        return redirect(route('home'));
    }

    /**
     * Validation rules for the sign up.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ];
    }
}
