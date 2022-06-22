<?php

namespace App\Http\Controllers;

use App\DataTables\Experts\ExpertsDataTable;
use App\Models\Configurations\AcademicLevel;
use App\Models\Configurations\Discipline;
use App\Models\Ratings\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $dataTable = new ExpertsDataTable($request);

            return $dataTable->render();
        }

        return view('writers.writers', [
            'disciplines' => Discipline::all(),
        ]);
    }

    public function show($id)
    {
        return view('writers.show', [
            'writer' => User::with('writerProfile', 'skill')->findOrFail($id),
            'academicLevels' => AcademicLevel::all(),
            'reviews' => Rating::reviews($id)->where('type', 'client_mark')->get()
        ]);
    }
}
