<?php

namespace App\Http\Controllers;

use App\Models\Career;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::open()->orderBy('sort')->orderByDesc('posted_at')->get();
        $units = $careers->pluck('unit')->filter()->unique()->values();

        return view('pages.career', compact('careers', 'units'));
    }

    public function show(Career $career)
    {
        abort_unless($career->is_open, 404);

        $related = Career::open()->where('id', '!=', $career->id)->orderBy('sort')->take(3)->get();

        return view('pages.career-show', compact('career', 'related'));
    }
}
