<?php

namespace App\Http\Controllers;

use App\Models\Samples\Sample;
use App\Models\Samples\SampleCategory;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index()
    {
        return view('samples.index', [
            'samples' => Sample::published(),
            'categories' => SampleCategory::withCount('samples')->get()
        ]);
    }

    public function show($slug)
    {
        $sample = Sample::whereslug($slug)->first();

        if (!is_null($sample)) {
            return view('samples.show', [
                'sample' => $sample
            ]);
        }

        $words = str_replace('-', ' ', $slug);
        $category = SampleCategory::whereName($words)->firstOrFail();

        $samples = Sample::fromCategory($category->name);

        return view('samples.index', [
            'samples' => $samples,
            'categories' => SampleCategory::withCount('samples')->get()
        ]);
    }


    public function search(Request $request)
    {
        return view('samples.index', [
            'samples' => Sample::search($request->get('query')),
            'categories' => SampleCategory::withCount('samples')->get()
        ]);
    }


}
