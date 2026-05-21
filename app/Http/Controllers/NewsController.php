<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use App\Models\NewsPost;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = NewsPost::with('category')->where('is_published', true);

        // Filter by category if requested
        if ($request->has('category')) {
            $category = NewsCategory::where('slug', $request->category)->first();
            if ($category) {
                $query->where('news_category_id', $category->id);
            }
        }

        // Featured news for headline
        $featured = null;
        if (!$request->has('category') && !$request->has('page') || $request->page == 1) {
            $featured = NewsPost::with('category')
                ->where('is_published', true)
                ->where('is_featured', true)
                ->latest('published_at')
                ->first();
                
            if ($featured) {
                $query->where('id', '!=', $featured->id);
            }
        }

        $news = $query->latest('published_at')->paginate(9)->withQueryString();
        
        $categories = NewsCategory::withCount('posts')->get();
        
        $popular = NewsPost::where('is_published', true)
            ->where('is_popular', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('frontend.berita.index', compact('news', 'featured', 'categories', 'popular'));
    }

    public function show($slug)
    {
        $post = NewsPost::with(['category', 'galleries'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
            
        $related = NewsPost::where('is_published', true)
            ->where('news_category_id', $post->news_category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();
            
        $popular = NewsPost::where('is_published', true)
            ->where('is_popular', true)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(4)
            ->get();
            
        $categories = NewsCategory::withCount('posts')->get();

        return view('frontend.berita.show', compact('post', 'related', 'popular', 'categories'));
    }
}
