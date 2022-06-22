<?php

namespace App\Http\Controllers;

use Alert;
use App\Mail\ContactFormEmail;
use App\Models\Services\Service;
use App\Rules\ValidRecaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    /**
     * Load the website home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages.home');
    }

    /**
     * Get the page being requested
     *
     * @param $page
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function page($page)
    {
        // The service
        $service = Service::findBySlug($page)->first();

        if ($service) {
            return view('pages.service', [
                'service' => $service,
            ]);
        }

        $view = 'pages.' . str_replace('-', '_', $page);

        if (View::exists($view)) {
            return view($view);
        }

        return abort('404');
    }
}
