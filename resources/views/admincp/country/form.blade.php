@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý danh mục</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!isset($country))
                        <h2>Thêm danh mục</h2>
                        <br><br>
                        {!! Form::open(['route' => 'country.store', 'method' => 'POST']) !!}
                    @else
                        <h2>Sửa danh mục</h2><br><br>
                        {!! Form::model($country, ['route' => ['country.update', $country->id], 'method' => 'PUT']) !!}
                    @endif

                    {{-- //giải thích: laravel collective form open method 
                        giúp tạo ra form với method post và action là url 
                        mà không cần phải viết thủ công như form thông thường --}}
                    {!! Form::open(['route' => 'country.store', 'method' => 'POST']) !!}
                        <div class = "form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($country) ? $country->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                        </div>
                        <div class = "form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($country) ? $country->slug : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'convert_slug']) !!}
                        </div>
                        <div class = "form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($country) ? $country->description : '', ['style'=>'resize:none','class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'title_danhmuc']) !!}
                        </div>
                        <div class = "form-group">
                            {!! Form::label('description', 'Active', []) !!}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($country) ? $country->status : '', ['class' => 'form-control']) !!}
                        </div>
                            {{-- form:submit là nút submit --}}

                        @if(!isset($country))
                            {!! Form::submit('Thêm danh mục', ['class' => 'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Sửa danh mục', ['class' => 'btn btn-success']) !!}
                        @endif
                    {!! Form::close() !!}
                </div>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Description</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col">Manage</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($list as $key => $cate)
                  <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$cate->title}}</td>
                    <td>{{$cate->slug}}</td>
                    <td>{{$cate->description}}</td>
                    <td>
                        @if ($cate->status == 1)
                            <span class="badge badge-success">Hiển thị</span>
                        @else
                            <span class="badge badge-danger">Không</span>
                        @endif
                    </td>
                    <td>
                        {!! Form::open(['route' => ['country.destroy', $cate->id], 'method' => 'DELETE', 'onsubmit'=>'return confirm("Bạn chắc chắn muốn xóa?")']) !!}
                            <a href="{{route('country.edit', $cate->id)}}" class="btn btn-primary">Sửa</a>
                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                  </tr>
                    @endforeach
    
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
