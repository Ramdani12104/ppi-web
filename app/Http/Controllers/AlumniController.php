<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Testimonial::where('type', 'Alumni')
            ->orWhere('type', 'alumni')
            ->latest()
            ->get();

        return view('frontend.program.alumni', compact('alumni'));
    }
}
