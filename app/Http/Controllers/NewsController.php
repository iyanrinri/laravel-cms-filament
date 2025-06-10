<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display the landing page with latest news.
     */
    public function landing()
    {
        $latestNews = News::with(['tags', 'categories'])
            ->orderByDesc('published_at')
            ->take(6)
            ->get();
        return view('welcome', compact('latestNews'));
    }

    /**
     * Display a listing of the news.
     */
    public function index()
    {
        $news = News::with(['tags', 'categories'])
            ->orderByDesc('published_at')
            ->paginate(9);
        return view('news.index', compact('news'));
    }

    /**
     * Display the specified news detail.
     */
    public function show($slug)
    {
        $news = News::with(['tags', 'categories'])
            ->where('slug', $slug)
            ->firstOrFail();
        return view('news.detail', compact('news'));
    }
}
