<?php

namespace App\Http\Controllers;

use App\Models\SditSetting;
use Illuminate\Http\Request;

class SditController extends Controller
{
    public function index()
    {
        $sdit = SditSetting::with(['programs', 'advantages', 'galleries', 'achievements'])
            ->where('is_publish', true)
            ->latest()
            ->first();

        return view('frontend.program.sdit', compact('sdit'));
    }
}
