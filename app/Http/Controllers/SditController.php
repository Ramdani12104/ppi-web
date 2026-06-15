<?php

namespace App\Http\Controllers;

use App\Models\SditSetting;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SditController extends Controller
{
    public function index()
    {
        $sdit = SditSetting::with(['programs', 'advantages', 'galleries', 'achievements'])
            ->where('is_publish', true)
            ->latest()
            ->first();

        $teachers = Teacher::where('stage', 'sdit')->orderBy('sort_order', 'asc')->get();

        return view('frontend.program.sdit', compact('sdit', 'teachers'));
    }
}
