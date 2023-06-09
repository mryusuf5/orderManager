<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--    <link href="{{asset('css/bootstrap/bootstrap.css')}}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://bootswatch.com/5/{{$settings->style}}/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/e0462e4fee.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('adminStyles')
    <title>Order Manager</title>
</head>
<body>
    <div class="d-flex">
        <x-admin.sidebar></x-admin.sidebar>
        <main class="mx-2 w-100">
            <br>
            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    <h3 class="text-white">{{$message}}</h3>
                </div>
            @endif
            <h3>{{$title ?? ''}}</h3>
            <hr>

            @isset($backButtonRoute)
                <a href="{{$backButtonRoute}}" class="mb-2">
                    <i class="fa-solid fa-chevron-left"></i> Terug
                </a>
                <br>
                <br>
            @endisset

            @isset($addButton)
            <a href="#" data-bs-toggle="modal" data-bs-target="#{{$target ?? ''}}" class="btn btn-primary mb-2">
                {{$addButton}}
            </a>
            @endisset

            {{$slot}}
        </main>
    </div>
    <x-admin.footer></x-admin.footer>
</body>
</html>
