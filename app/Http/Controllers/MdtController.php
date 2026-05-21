<?php

namespace App\Http\Controllers;

use App\Models\MdtSetting;
use Illuminate\Http\Request;

class MdtController extends Controller
{
    public function index()
    {
        $mdt = MdtSetting::with(['programs', 'advantages', 'galleries'])
            ->where('is_publish', true)
            ->latest()
            ->first();

        return view('frontend.program.mdt', compact('mdt'));
    }
}
