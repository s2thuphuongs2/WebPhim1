<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class GenreController extends Controller
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
        // giải thích: khi gọi đến route('genre.create') thì sẽ chạy vào hàm create() trong GenreController
        // trong hàm create() sẽ trả về view('admincp.genre.form')
        // trong view('admincp.genre.form') sẽ gọi đến file form.blade.php trong thư mục admincp.genre
        // list là biến dùng để lưu danh sách các genre
        // compact('list') là cách viết tắt của ['list' => $list]
        $list = Genre::all();
        return view('admincp.genre.form', compact('list'));
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
        $genre = new Genre();
        // Lấy dữ liệu dựa trên name
        $data = $request->only($genre->fillable);
        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->save();
        return redirect()->route('genre.create')->with('success', 'Thêm mới thành công');
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
        $genre = Genre::findOrFail($id); // tìm kiếm genre theo id
        $list = Genre::all(); // lấy danh sách genre
        return view('admincp.genre.form', compact('list', 'genre')); // trả về view('admincp.genre.form') với 2 biến genre và list
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
        $genre = Genre::find($id);
        // Lấy dữ liệu dựa trên name
        $data = $request->only($genre->fillable);
        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->save();
        return redirect()->back();
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
        Genre::find($id)->delete();
        return redirect()->route('genre.create')->with('success', 'Xóa thành công');
    }
}
