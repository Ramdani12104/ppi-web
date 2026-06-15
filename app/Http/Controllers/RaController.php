<?php

namespace App\Http\Controllers;

use App\Models\RaSetting;
use App\Models\Teacher;
use Illuminate\Http\Request;

class RaController extends Controller
{
    public function index()
    {
        $ra = RaSetting::with(['programs', 'advantages', 'galleries'])
            ->where('is_publish', true)
            ->latest()
            ->first();

        $teachers = Teacher::where('stage', 'ra')->orderBy('sort_order', 'asc')->get();

        return view('frontend.program.ra', compact('ra', 'teachers'));
    }
}
