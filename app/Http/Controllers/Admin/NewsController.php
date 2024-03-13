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

        // get data terbaru dari table news dari model news
        $news = News::latest()->paginate(3);
        $category = Category::all();

        // guna compact buat ngirim data ke view yang diambil dari variable diatas
        return view('home.news.index', compact('title','news','category'));
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
        $image->storeAs('public/news/',$image->hashName());

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

        // get data by id
        // findOrFail guna buat klo data ga ada maka eror 404
        $news = News::findOrFail($id);

        $title = 'show - news';
        return view('home.news.show' , compact('title','news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get data by id
        $news = News::findOrFail($id);
        $category = Category::all();
        $title = 'edit - news';

        return view('home.news.edit', compact('category','news','title'));
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
