<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class TabunganUmrohController extends Controller
{
    public function index()
    {
        // Pluck setting values
        $settings = Setting::pluck('value', 'key')->toArray();

        // Decode JSON array keys
        $settings['umroh_packages'] = isset($settings['umroh_packages']) ? json_decode($settings['umroh_packages'], true) : [];
        $settings['umroh_steps'] = isset($settings['umroh_steps']) ? json_decode($settings['umroh_steps'], true) : [];
        $settings['umroh_testimonials'] = isset($settings['umroh_testimonials']) ? json_decode($settings['umroh_testimonials'], true) : [];

        return view('frontend.program.tabungan-umroh', compact('settings'));
    }
}
