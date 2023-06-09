<div class="card d-flex col-lg-3 col-md-5 col-10 justify-content-center align-items-center">
    <div class="card-content">
        @isset($image)
            <img src="{{$image}}" class="card-img-top">
            <h5>{{$title}}</h5>
        @else
            <h1>{{$title}}</h1>
        @endisset
        <a href="{{$route}}" class="btn btn-primary w-100 card-btn">Aanpassen</a>
        <br>
        @isset($userRoute)
            <a href="{{$userRoute}}" target="_blank" class="btn btn-primary w-100 card-btn">Open user view</a>
        @endisset
    </div>
</div>
@section('adminStyles')
    <style>
        .card-content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            height: 100%;
        }

        .card-btn {
            margin-top: auto;
        }
    </style>
@endsection
