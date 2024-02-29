<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Title halaman
        $title = 'Category - Index';
        // Mengurutkan data berdasarkan "terbaru"
        $category = Category::latest()->get();

        return view('home.category.index', compact(
            'category',
            'title'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Title halaman
        $title = 'Category - Index';
        return view('home.category.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // melakukan upload img
        $image = $request->file('image');
        $image->storeAs('public/category', $image->hashName());
        // Generate nama unik 'hashName'
        // generate nama asli dari image getClientOriginalName



        // Save to DataBase
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $image->hashName()
        ]);



        // return redirect
        return redirect()->route('category.index')->with('success', 'Category berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // hal edit
        // Title halaman
        $title = 'Category - Index';
        $category = Category::find($id);
        return view('home.category.edit', compact('category', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
