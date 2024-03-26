<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;

class FrontEndController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();
        $sliderNews = News::latest()->limit(3)->get();
        // get data news by category 
        return view('frontend.news.index', compact('category', 'sliderNews'));
    }

    public function detailNews($slug){
        $category = Category::latest()->get();
        $news = News::where('slug', $slug)->first();
        $title = 'Detail News';

        return view('frontend.news.detail',compact('category','news','title'));
    }

    public function detailCategory($slug){
        $category = Category::latest()->get();

        // category by slug
        $detailCategory = Category::where('slug', $slug)->first();

        // get data news by category
        $news = News::where('category_id')->latest()->get();
        
        return view('frontend.news.detailCategory', compact('category','detailCategory','news'));
    }
}

