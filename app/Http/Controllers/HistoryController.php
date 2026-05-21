<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $history = \App\Models\History::first();
        return view('sejarah', compact('history'));
    }
}
