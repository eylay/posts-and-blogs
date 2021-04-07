@extends('layouts.master')

@section('head')
    @if ($post->id)
        <title> ویرایش پست {{$post->title}} </title>
    @else
        <title> تعریف پست </title>
    @endif
@endsection

@section('content')
    @if ($post->id)
        <h3> ویرایش پست </h3>
    @else
        <h3> تعریف پست </h3>
    @endif
    <form class="row" action="{{$post->id ? route('posts.update', $post->id) : route('posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @if ($post->id)
            @method('PUT')
        @endif
        <div class="col-md-4 my-1">
            <div class="mb-2">
                <label> عنوان پست </label>
                <input type="text" class="form-control" name="title" value="{{$post->title ?? old('title')}}">
            </div>
            <div class="mb-2">
                @if ($post->image)
                    <label> جایگزین کردن تصویر قبلی </label>
                    <img src="{{asset($post->image)}}" alt="{{$post->title}}" class="img-fluid">
                @else
                    <label> آپلود تصویر جدید</label>
                @endif
                <input type="file" class="form-control" name="image">
            </div>
        </div>
        <div class="col-md-8 my-1">
            <label> توضیحات پست </label>
            <textarea name="description" class="form-control" rows="8">{{$post->description ?? old('description')}}</textarea>
        </div>
        <div class="col-md-2 my-1 d-grid mx-auto">
            <button type="submit" class="btn btn-primary"> تایید و ذخیره </button>
        </div>
    </form>
@endsection
