<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WakafSetting;

class WakafController extends Controller
{
    public function index()
    {
        $wakaf = WakafSetting::with(['programs', 'timelines', 'progresses', 'galleries'])->first();
        return view('frontend.dukungan.index', compact('wakaf'));
    }
}
