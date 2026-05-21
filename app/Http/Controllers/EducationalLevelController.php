<?php

namespace App\Http\Controllers;

use App\Models\EducationalLevel;
use Illuminate\Http\Request;

class EducationalLevelController extends Controller
{
    public function show($slug)
    {
        $level = EducationalLevel::where('slug', $slug)->where('is_active', true)->firstOrFail();

        return view('frontend.educational_level', compact('level'));
    }
}
