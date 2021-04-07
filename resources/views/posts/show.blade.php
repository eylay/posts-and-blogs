@extends('layouts.master')

@section('head')
    <title> {{$post->title}} </title>
@endsection

@section('content')

    <div class="d-flex justify-content-between">
        <h3> {{$post->title}} </h3>
        <div>
            {{carbonToPersian($post->created_at)->format('Y-m-d')}}
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <img src="{{asset($post->image)}}" alt="{{$post->title}}" class="img-fluid">
        </div>
        <div class="col-md-9">
            <p> {{$post->description}} </p>
        </div>
    </div>

@endsection
