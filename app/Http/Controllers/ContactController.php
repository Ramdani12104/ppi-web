<?php

namespace App\Http\Controllers;

use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $setting = ContactSetting::with('contacts')
            ->where('is_publish', true)
            ->first();

        return view('frontend.kontak.index', compact('setting'));
    }
}
