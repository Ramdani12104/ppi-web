<?php

namespace App\Http\Controllers;

use App\Models\MTsSetting;
use Illuminate\Http\Request;

class MTsController extends Controller
{
    public function index()
    {
        $mtsSettings = MTsSetting::first();
        return view('mts', compact('mtsSettings'));
    }
}
