<?php

namespace App\Http\Controllers;

use App\Models\TokohPendiriSetting;
use Illuminate\Http\Request;

class TokohPendiriController extends Controller
{
    public function index()
    {
        $pendiri = TokohPendiriSetting::with(['families', 'timelines', 'galleries'])
            ->where('is_publish', true)
            ->latest()
            ->first();

        return view('frontend.profil.tokoh-pendiri', compact('pendiri'));
    }
}
