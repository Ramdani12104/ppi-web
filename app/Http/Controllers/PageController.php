<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::with(['sections' => function($q) {
            $q->where('is_active', true)->orderBy('order');
        }])->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('frontend.dynamic_page', compact('page'));
    }
}
