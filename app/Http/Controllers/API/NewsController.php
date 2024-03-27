<?php

namespace App\Http\Controllers\API;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        try {
            $news = News::latest()->get();
            return ResponseFormatter::success(
                $news,
                'Data list of news'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function show($id)
    {
        try {
            // get data by id
            $news = News::findOrFail($id);
            return ResponseFormatter::success(
                $news,
                'Data news by id'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // validasi
            $this->validate($request, [
                'title' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
                'content' => 'required',
                'category_id' => 'required'
            ]);
            // upload image
            $image = $request->file('image');

            // fungsi buat nyimpen image ek dalam folder public/news
            // hashname() gunanya buat ngasih nama random ke file image
            $image->storeAs('public/news/', $image->hashName());

            //create data
            $news = News::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'image' => $image->hashName(),
                'content' => $request->content,
                'category_id' => $request->category_id
            ]);

            return ResponseFormatter::success($news, 'News created successfully');

        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }
}
