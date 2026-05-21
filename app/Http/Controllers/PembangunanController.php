<?php

namespace App\Http\Controllers;

use App\Models\PembangunanSetting;
use Illuminate\Http\Request;

class PembangunanController extends Controller
{
    public function index()
    {
        $setting = PembangunanSetting::with(['projects', 'histories', 'galleries'])
            ->where('is_publish', true)
            ->first();

        return view('frontend.dukungan.pembangunan', compact('setting'));
    }
}
