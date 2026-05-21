<?php

namespace App\Http\Controllers;

use App\Models\SaranaSetting;
use Illuminate\Http\Request;

class SaranaController extends Controller
{
    public function index()
    {
        $sarana = SaranaSetting::with(['facilities', 'galleries'])
            ->where('is_publish', true)
            ->latest()
            ->first();

        return view('frontend.profil.sarana', compact('sarana'));
    }
}
