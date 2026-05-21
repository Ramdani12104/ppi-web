<?php

namespace App\Http\Controllers;

use App\Models\BeasiswaSetting;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    public function index()
    {
        $setting = BeasiswaSetting::with(['programs', 'histories', 'galleries'])
            ->where('is_publish', true)
            ->first();

        return view('frontend.dukungan.beasiswa', compact('setting'));
    }
}
