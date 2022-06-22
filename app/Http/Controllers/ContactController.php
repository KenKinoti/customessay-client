<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormEmail;
use App\Rules\ValidRecaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.contact');
    }

    /**
     * Send contact form content to contact email
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules());

        $enquiry = new \stdClass();
        $enquiry->senderEmail = $request->email;
        $enquiry->senderName = $request->name;
        $enquiry->subject = $request->subject;
        $enquiry->message = $request->message;

        Mail::to(config('system.contact_email'))->send(new ContactFormEmail($enquiry));

        Alert::success(__('alert.success'), __('pages.contacts.sent'));

        return redirect()->back();
    }

    /**
     * Validation rules for the contact form
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:3|max:150',
            'email' => 'required|email|max:255',
            'subject' => 'required|min:5|max:255',
            'message' => 'required|min:5|max:600',
        ];

        if (App::environment('production')) {
            $rules['captcha'] = ['required', new ValidRecaptcha];
        }

        return $rules;
    }
}
