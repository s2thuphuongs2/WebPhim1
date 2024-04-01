<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
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
        // giải thích: khi gọi đến route('category.create') thì sẽ chạy vào hàm create() trong CategoryController
        // trong hàm create() sẽ trả về view('admincp.category.form')
        // trong view('admincp.category.form') sẽ gọi đến file form.blade.php trong thư mục admincp.category
        // list là biến dùng để lưu danh sách các category
        // compact('list') là cách viết tắt của ['list' => $list]
        $list = Category::all();
        return view('admincp.category.form', compact('list'));
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
        $category = new Category();
        // Lấy dữ liệu dựa trên name
        $data = $request->only($category->fillable);
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->save();
        return redirect()->route('category.create')->with('success', 'Thêm mới thành công');
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
        $category = Category::findOrFail($id); // tìm kiếm category theo id
        $list = Category::all(); // lấy danh sách category
        return view('admincp.category.form', compact('list', 'category')); // trả về view('admincp.category.form') với 2 biến category và list
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
        $category = Category::find($id);
        // Lấy dữ liệu dựa trên name
        $data = $request->only($category->fillable);
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->save();
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
        Category::find($id)->delete();
        return redirect()->route('category.create')->with('success', 'Xóa thành công');
    }
}
