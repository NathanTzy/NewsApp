<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'index news';
        // guna compact buat ngirim data ke view
        return view('home.news.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create page";

        // model category
        $category = Category::all();

        return view('home.news.create', compact('title', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5020',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        // upload image
        $image = $request->file('image');

        // fungsi buat nyimpen image ek dalam folder public/news
        // hashname() gunanya buat ngasih nama random ke file image
        $image->storeAs('public/news',$image->hashName());

        //create data
        News::create([
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->title, '-'),
            'title' => $request->title,
            'image' => $image->hashName(),
            'content' => $request->content
        ]);

        return redirect()->route('news.index')->with((['udah' => 'Berita ditambahkan']));
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
        //
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
