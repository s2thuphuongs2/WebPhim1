@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý thể loại</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!isset($genre))
                        <h2>Thêm thể loại</h2>
                        <br><br>
                        {!! Form::open(['route' => 'genre.store', 'method' => 'POST']) !!}
                    @else
                        <h2>Sửa thể loại</h2><br><br>
                        {!! Form::model($genre, ['route' => ['genre.update', $genre->id], 'method' => 'PUT']) !!}
                    @endif

                    {{-- //giải thích: laravel collective form open method 
                        giúp tạo ra form với method post và action là url 
                        mà không cần phải viết thủ công như form thông thường --}}
                    {!! Form::open(['route' => 'genre.store', 'method' => 'POST']) !!}
                        <div class = "form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($genre) ? $genre->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                        </div>
                        <div class = "form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($genre) ? $genre->slug : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'convert_slug']) !!}
                        </div>
                        <div class = "form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($genre) ? $genre->description : '', ['style'=>'resize:none','class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'title_danhmuc']) !!}
                        </div>
                        <div class = "form-group">
                            {!! Form::label('description', 'Active', []) !!}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($genre) ? $genre->status : '', ['class' => 'form-control']) !!}
                        </div>
                            {{-- form:submit là nút submit --}}

                        @if(!isset($genre))
                            {!! Form::submit('Thêm thể loại', ['class' => 'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Sửa thể loại', ['class' => 'btn btn-success']) !!}
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
                        {!! Form::open(['route' => ['genre.destroy', $cate->id], 'method' => 'DELETE', 'onsubmit'=>'return confirm("Bạn chắc chắn muốn xóa?")']) !!}
                            <a href="{{route('genre.edit', $cate->id)}}" class="btn btn-primary">Sửa</a>
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
