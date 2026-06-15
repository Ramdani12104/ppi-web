<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $galleryItems = Gallery::where('jenjang', '!=', 'Sejarah')->latest()->get()->toArray();
        $historicalItems = Gallery::where('jenjang', 'Sejarah')->latest()->get()->toArray();
        
        return view('frontend.gallery', compact('settings', 'galleryItems', 'historicalItems'));
    }
}
