<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class TabunganKurbanController extends Controller
{
    public function index()
    {
        // Pluck setting values
        $settings = Setting::pluck('value', 'key')->toArray();

        // Decode JSON array keys
        $settings['kurban_packages'] = isset($settings['kurban_packages']) ? json_decode($settings['kurban_packages'], true) : [];
        $settings['kurban_steps'] = isset($settings['kurban_steps']) ? json_decode($settings['kurban_steps'], true) : [];
        $settings['kurban_testimonials'] = isset($settings['kurban_testimonials']) ? json_decode($settings['kurban_testimonials'], true) : [];

        return view('frontend.program.tabungan-kurban', compact('settings'));
    }
}
