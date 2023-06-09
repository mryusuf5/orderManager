<div class="card d-flex col-lg-3 col-md-5 col-10 justify-content-center align-items-center">
    <div class="card-content">
        @isset($image)
            <img src="{{$image}}" class="card-img-top">
        @endisset
        <h1>{{$title}}</h1>
        <p>{{$description}}</p>
        <p>{{$remark}}</p>
        <p>{{$sauces}}</p>
        <p>{{$price}}</p>
        @isset($route)
            <a href="{{$route}}" class="btn btn-primary w-100 card-btn">Bekijken</a>
        @endisset
        <br>
        {{$slot}}
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
