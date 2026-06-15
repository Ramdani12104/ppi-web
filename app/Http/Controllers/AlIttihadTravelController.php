<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AlIttihadTravelController extends Controller
{
    public function index()
    {
        // Pluck setting values
        $settings = Setting::pluck('value', 'key')->toArray();

        // Decode JSON array keys
        $settings['travel_items'] = isset($settings['travel_items']) ? json_decode($settings['travel_items'], true) : [];

        return view('frontend.program.al-ittihad-travel', compact('settings'));
    }
}
