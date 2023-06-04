<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/bootstrap/bootstrap.css')}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e0462e4fee.js" crossorigin="anonymous"></script>
    @yield('adminStyles')
    <title>Order Manager</title>
</head>
<body>
    <div class="d-flex">
        <x-admin.sidebar></x-admin.sidebar>
        <main class="mx-2">
            <h3>{{$title ?? ''}}</h3>
            {{$slot}}
        </main>
    </div>
    <x-admin.footer></x-admin.footer>
</body>
</html>
