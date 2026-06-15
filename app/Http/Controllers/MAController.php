<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MASetting;
use App\Models\NewsPost;
use App\Models\Testimonial;
use App\Models\Teacher;

class MAController extends Controller
{
    public function index()
    {
        $maSettings = MASetting::first();
        $news = NewsPost::where('is_published', true)->latest('published_at')->take(3)->get();
        $testimonials = Testimonial::latest()->take(3)->get();
        $teachers = Teacher::where('stage', 'ma')->orderBy('sort_order', 'asc')->get();
        
        return view('ma', compact('maSettings', 'news', 'testimonials', 'teachers'));
    }
}
