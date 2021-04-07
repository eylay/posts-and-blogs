<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="utf-8">

        @yield('head')

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('app/styles.css')}}">
    </head>
    <body>

        <div class="main-container container">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link @if(rn() == 'landing-page') active @endif" href="{{route('landing-page')}}">صفحه اصلی</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(rn() == 'posts.index') active @endif" href="{{route('posts.index')}}">لیست همه پست ها</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(rn() == 'posts.create') active @endif" href="{{route('posts.create')}}">تعریف پست جدید</a>
                </li>
            </ul>
            <hr>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li> {{$error}} </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif

            @yield('content')


        </div>

    </body>
</html>
