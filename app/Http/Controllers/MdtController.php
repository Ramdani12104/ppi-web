<?php

namespace App\Http\Controllers;

use App\Models\MdtSetting;
use App\Models\Teacher;
use Illuminate\Http\Request;

class MdtController extends Controller
{
    public function index()
    {
        $mdt = MdtSetting::with(['programs', 'advantages', 'galleries'])
            ->where('is_publish', true)
            ->latest()
            ->first();

        $teachers = Teacher::where('stage', 'mdt')->orderBy('sort_order', 'asc')->get();

        return view('frontend.program.mdt', compact('mdt', 'teachers'));
    }
}
