<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class KopontrenController extends Controller
{
    public function index()
    {
        // Pluck setting values
        $settings = Setting::pluck('value', 'key')->toArray();

        // Decode JSON array keys
        $settings['kopontren_packages'] = isset($settings['kopontren_packages']) ? json_decode($settings['kopontren_packages'], true) : [];
        $settings['kopontren_steps'] = isset($settings['kopontren_steps']) ? json_decode($settings['kopontren_steps'], true) : [];

        return view('frontend.program.kopontren', compact('settings'));
    }
}
