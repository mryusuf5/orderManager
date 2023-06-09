<div class="modal fade" id="{{$id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <form action="{{$route}}{{'/' . isset($routeId)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nieuwe {{$title}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{$slot}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </div>
            </div>
        </div>
    </form>
</div>
