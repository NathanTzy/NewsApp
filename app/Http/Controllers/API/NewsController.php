<?php

namespace App\Http\Controllers\API;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

    public function destroy($id)
    {
        try {
            //get data by id
            $news = News::find($id);

            // delete image
            Storage::disk('local')->delete('public/news/' . basename($news->image));

            // delete data by id
            $news->delete();

            return ResponseFormatter::success(null, 'Deleting news success');
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'title' => 'required|max:255',
                'category_id' => 'required',
                'content' => 'required',
                'image' =>  'image|mimes:jpg,png,jpeg|max:5200'
            ]);

            // get data news by id
            $news = News::findOrFail($id);

            // klo g ada image yng di upload
            if ($request->file('image') == '') {
                // update data
                $news->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'category_id' => $request->category_id,
                    'content' => $request->content
                ]);
            } else {
                //hapus foto
                Storage::disk('local')->delete('public/news/' . basename($news->image));

                // upload image
                $image = $request->file('image');
                $image->storeAs('public/news', $image->hashName());

                // upload data
                $news->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'category_id' => $request->category_id,
                    'image' => $image->hashName(),
                    'content' => $request->content
                ]);
            }

            return ResponseFormatter::success(
                $news,
                "News has been updated"
            );

        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }
}
