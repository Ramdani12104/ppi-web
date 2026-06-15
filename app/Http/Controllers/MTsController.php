<?php

namespace App\Http\Controllers;

use App\Models\MTsSetting;
use App\Models\NewsPost;
use App\Models\Teacher;
use Illuminate\Http\Request;

class MTsController extends Controller
{
    public function index()
    {
        $mtsSettings = MTsSetting::first();
        $news = NewsPost::where('is_published', true)->latest('published_at')->take(3)->get();
        $teachers = Teacher::where('stage', 'mts')->orderBy('sort_order', 'asc')->get();
        return view('mts', compact('mtsSettings', 'news', 'teachers'));
    }
}
