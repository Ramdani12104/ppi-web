<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class KatalogSeragamController extends Controller
{
    public function index()
    {
        // Pluck setting values
        $settings = Setting::pluck('value', 'key')->toArray();

        // Decode JSON array keys
        $settings['seragam_items'] = isset($settings['seragam_items']) ? json_decode($settings['seragam_items'], true) : [];

        return view('frontend.program.katalog-seragam', compact('settings'));
    }
}
