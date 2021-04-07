@extends('layouts.master')

@section('head')
    <title> لیست پست ها </title>
@endsection

@section('content')
    <form class="row my-3 justify-content-center" action="" method="get">
        <div class="col-md-3">
            <label> عنوان مورد نظر </label>
            <input type="text" class="form-control" name="t" value="{{request('t')}}">
        </div>
        <div class="col-md-3">
            <label> مرتب سازی بر حسب </label>
            <select class="form-control" name="o">
                <option value=""> -- انتخاب کنید -- </option>
                <option value="1" @if(request('o') == 1) selected @endif> جدیدترین </option>
                <option value="2" @if(request('o') == 2) selected @endif> قدیمی ترین </option>
                <option value="3" @if(request('o') == 3) selected @endif> عنوان </option>
            </select>
        </div>
        <div class="col-md-2 align-self-center form-check">
            <input id="with-image" type="checkbox" @if(request('i')) checked @endif name="i" value="1">
            <label for="with-image"> تصویر دار </label>
        </div>
        <div class="w-100"></div>
        <div class="col-md-2 mt-2 d-grid align-self-center">
            <button type="submit" class="btn btn-primary btn-block"> جستجو </button>
        </div>
    </form>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">عنوان</th>
                <th scope="col">توضیحات</th>
                <th scope="col">تصویر</th>
                <th scope="col" colspan="3">عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $key => $post)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{short($post->description)}}</td>
                    <td>
                        @if ($post->image)
                            <span class="text-success"> بلی </span>
                        @else
                            <span class="text-danger"> خیر </span>
                        @endif
                    </td>
                    <td> <a href="{{route('posts.show', $post->id)}}" class="btn btn-primary btn-sm"> پیش نمایش </a> </td>
                    <td> <a href="{{route('posts.edit', $post->id)}}" class="btn btn-success btn-sm"> ویرایش </a> </td>
                    <td>
                        <form action="{{route('posts.destroy', $post->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('آیا مطمئن هستید؟');" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$posts->links()}}
@endsection
