<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MASetting;

class MAController extends Controller
{
    public function index()
    {
        $maSettings = MASetting::first();
        
        return view('ma', compact('maSettings'));
    }
}
