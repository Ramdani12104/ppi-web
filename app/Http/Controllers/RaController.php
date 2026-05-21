<?php

namespace App\Http\Controllers;

use App\Models\RaSetting;
use Illuminate\Http\Request;

class RaController extends Controller
{
    public function index()
    {
        $ra = RaSetting::with(['programs', 'advantages', 'galleries'])
            ->where('is_publish', true)
            ->latest()
            ->first();

        return view('frontend.program.ra', compact('ra'));
    }
}
