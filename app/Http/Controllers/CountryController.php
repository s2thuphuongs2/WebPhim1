<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
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
        // giải thích: khi gọi đến route('country.create') thì sẽ chạy vào hàm create() trong CountryController
        // trong hàm create() sẽ trả về view('admincp.country.form')
        // trong view('admincp.country.form') sẽ gọi đến file form.blade.php trong thư mục admincp.country
        // list là biến dùng để lưu danh sách các country
        // compact('list') là cách viết tắt của ['list' => $list]
        $list = Country::all();
        return view('admincp.country.form', compact('list'));
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
        $country = new Country();
        // Lấy dữ liệu dựa trên name
        $data = $request->only($country->fillable);
        $country->title = $data['title'];
        $country->slug = $data['slug'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->save();
        return redirect()->route('country.create')->with('success', 'Thêm mới thành công');
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
        $country = Country::findOrFail($id); // tìm kiếm country theo id
        $list = Country::all(); // lấy danh sách country
        return view('admincp.country.form', compact('list', 'country')); // trả về view('admincp.country.form') với 2 biến country và list
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
        $country = Country::find($id);
        // Lấy dữ liệu dựa trên name
        $data = $request->only($country->fillable);
        $country->title = $data['title'];
        $country->slug = $data['slug'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->save();
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
        Country::find($id)->delete();
        return redirect()->route('country.create')->with('success', 'Xóa thành công');
    }
}
