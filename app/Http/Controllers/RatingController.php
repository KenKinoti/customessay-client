<?php

namespace App\Http\Controllers;

use App\Models\Ratings\Rating;

class RatingController extends Controller
{
    public function index()
    {
        return view('page.components.reviews', [
            'reviews' => Rating::reviews()->get()
        ]);
    }
}
