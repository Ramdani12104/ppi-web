<?php

namespace App\Http\Controllers;

use App\Models\KoberSetting;
use App\Models\Teacher;
use Illuminate\Http\Request;

class KoberController extends Controller
{
    public function index()
    {
        $kober = KoberSetting::with(['programs', 'advantages', 'galleries'])
            ->where('is_publish', true)
            ->latest()
            ->first();

        $teachers = Teacher::where('stage', 'kober')->orderBy('sort_order', 'asc')->get();

        return view('frontend.program.kober', compact('kober', 'teachers'));
    }
}
