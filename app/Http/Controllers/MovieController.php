<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Category;
use App\Genre;
use App\Country;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //pluck là hàm lấy ra 1 cột trong bảng
        $category = Category::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        
        // $category = Category::orderBy('id', 'desc')->get();
        // $genre = Genre::orderBy('id', 'desc')->get();
        // $country = Country::orderBy('id', 'desc')->get();
        $list = Movie::orderBy('id', 'desc')->get();
        return view('admincp.movie.form', compact('list', 'category', 'genre', 'country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        // $movie->image = $data['image'];
        //$movie->image = "hinhanh"
        // Thêm hình ảnh
        // Khúc này nè -----------------------------
        $get_image = $request->file('image');
        $path = 'public/uploads/movie';
        if ($get_image) {
            // $path = 'public/uploads/movie';
            // getClientOriginalName() lấy ra tên của file
            $get_name_image = $get_image->getClientOriginalName(); //hinhanh.jpg
            // current() lấy ra phần tử đầu tiên của mảng
            $name_image = current(explode('.', $get_name_image)); //hinhanh . jpg 
            // rand(0, 99) lấy ra 1 số ngẫu nhiên từ 0 đến 99 để tránh trường hợp trùng tên file
            $new_image = $name_image.rand(0, 99).'.'.$get_image->getClientOriginalExtension();
            // move() di chuyển file vào thư mục
            $get_image->move('public/uploads/movie/', $new_image);
            // lưu tên file vào csdl
            $movie->image = $new_image;
        } 


        $movie->save();
        return redirect()->route('movie.create')->with('success', 'Thêm mới thành công');
        
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
