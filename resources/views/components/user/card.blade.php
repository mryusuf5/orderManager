<div class="card d-flex col-10 justify-content-center align-items-center mb-2 p-0">
    <div class="card-content">
        @isset($image)
            <img src="{{$image}}" class="card-img-top">
        @endisset
        <h5 class="p-2">{{$title}}</h5>
        {{$slot}}
        @isset($route)
            <form action="{{$route}}" method="post" class="confirmForm">
                @csrf
                @method('DELETE')
                <input type="submit" value="Verwijderen" class="btn btn-danger w-100 card-btn">
            </form>
        @else
            <a href="#" data-id="{{$id}}" class="btn btn-primary w-100 card-btn modalButton"
               data-bs-target="#productModal-{{$id}}" data-bs-toggle="modal">Bekijken</a>
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
