<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();

        try {
            return ResponseFormatter::success(
                $category,
                'Data category berhasil diambil'
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
            $category = Category::findOrFail($id);
            return ResponseFormatter::success(
                $category,
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
            $this->validate($request, [
                'name' => 'required|unique:categories',
                'image' => 'required|mimes:jpg,png,jpeg|image|max:2048',
            ]);

            // upload image to server
            $image = $request->file('image');
            $image->storeAs('public/category', $image->hashName());

            // store data
            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $image->hashName()
            ]);

            return ResponseFormatter::success([
                $category,
                'Data berhasil ditambahkan'
            ]);
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication failed', 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'image' => 'required|mimes:jpg,png,jpeg|max:2048'
            ]);

            // get data by id
            $category = Category::findOrFail($id);

            // store image
            if ($request->file('image') == '') {
                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug('$request->name')
                ]);
            } else {
                // Jika gambarnya diupdate
                // hapus image lama
                Storage::disk('local')->delete('public/category/' . basename($category->image));

                // upload image baru
                $image = $request->file('image');
                $image->storeAs('public/category', $image->hashName());

                // update data
                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'image' => $image->hashName()
                ]);
            }
            return ResponseFormatter::success(
            $category,
            'Data diganti'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication failed', 500);
        }
    }

    public function destroy($id){
        try {
            // get data by id
            $category = Category::findOrFail($id);
            // delete image
            Storage::disk('local')->delete('public/category/' . basename($category->image));
            // delete category
            $category->delete();
            return ResponseFormatter::success(
                null,
                'Category dihapus'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication failed', 500);
        }
    }
}
