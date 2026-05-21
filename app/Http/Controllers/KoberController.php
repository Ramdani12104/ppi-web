<?php

namespace App\Http\Controllers;

use App\Models\KoberSetting;
use Illuminate\Http\Request;

class KoberController extends Controller
{
    public function index()
    {
        $kober = KoberSetting::with(['programs', 'advantages', 'galleries'])
            ->where('is_publish', true)
            ->latest()
            ->first();

        return view('frontend.program.kober', compact('kober'));
    }
}
