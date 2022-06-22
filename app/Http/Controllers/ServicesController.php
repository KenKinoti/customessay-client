<?php

namespace App\Http\Controllers;

use App\Models\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{

   

    /**
     * Display the blog posts
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::service();
        return view('services.services', [
            'services' => $services
        ]);
    }



    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('services.show', [
            'service' => Service::whereSlug($slug)->firstOrFail()
        ]);
    }




}
