<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\DeveloperProperty;

class BlogController extends Controller
{
    public function index()
    {
        $locale = session('locale');

        $blogs = Blog::with([
            'translations' => function ($q) use ($locale) {
                $q->where('locale', $locale);
            },
        ])->latest()->paginate(9);

        return view('frontend.blog', compact('blogs'));
    }

    public function show($slug)
    {
        $data['blog'] = Blog::where('slug', $slug)->firstOrFail();
        $data['blogs'] = Blog::get();
        $data['developer_property'] = DeveloperProperty::first();

        return view('frontend.blog-detail', $data);
    }

    public function inner()
    {
        $data['blogs'] = Blog::get();
        $data['developer_property'] = DeveloperProperty::first();

        return view('frontend.blog-detail', $data);
    }

    public function latest()
    {
        return view('frontend.new_articles');
    }
}
