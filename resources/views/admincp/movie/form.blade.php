@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý phim</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!isset($movie))
                        <h2>Thêm phim</h2>
                        <br><br>
                        {!! Form::open(['route' => 'movie.store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                    @else
                        <h2>Sửa phim</h2><br><br>
                        {!! Form::model($movie, ['route' => ['movie.update', $movie->id], 'method' => 'PUT']) !!}
                    @endif

                    {{-- //giải thích: laravel collective form open method 
                        giúp tạo ra form với method post và action là url 
                        mà không cần phải viết thủ công như form thông thường --}}
                    {!! Form::open(['route' => 'movie.store', 'method' => 'POST']) !!}
                        <div class = "form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($movie) ? $movie->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                        </div>
                        <div class = "form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'convert_slug']) !!}
                        </div>
                        <div class = "form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['style'=>'resize:none','class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id'=>'title_danhmuc']) !!}
                        </div>
                          <div class = "form-group">
                            {!! Form::label('description', 'Active', []) !!}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($movie) ? $movie->status : '', ['class' => 'form-control']) !!}
                        </div>

                        <div class = "form-group">
                            {!! Form::label('Category', 'Category', []) !!}
                            {!! Form::select('category_id', $category, isset($movie) ? $movie->category : '', ['class' => 'form-control']) !!}
                        </div>
                        <div class = "form-group">
                            {!! Form::label('Country', 'Country', []) !!}
                            {!! Form::select('country_id', $country, isset($movie) ? $movie->country : '', ['class' => 'form-control']) !!}
                        </div>
                        <div class = "form-group">
                            {!! Form::label('Genre', 'Genre', []) !!}
                            {!! Form::select('genre_id', $genre, isset($movie) ? $movie->genre : '', ['class' => 'form-control']) !!}
                        </div>
                        {{-- // Khúc này nè ----------------------------- --}}
                        <div class = "form-group">
                            {!! Form::label('Image', 'Image', []) !!}
                            {!! Form::file('image', ['class' => 'form-control-file'] )!!}
                        </div>
                            {{-- form:submit là nút submit --}}

                        @if(!isset($movie))
                            {!! Form::submit('Thêm phim', ['class' => 'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Sửa phim', ['class' => 'btn btn-success']) !!}
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
                        {!! Form::open(['route' => ['movie.destroy', $cate->id], 'method' => 'DELETE', 'onsubmit'=>'return confirm("Bạn chắc chắn muốn xóa?")']) !!}
                            <a href="{{route('movie.edit', $cate->id)}}" class="btn btn-primary">Sửa</a>
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
