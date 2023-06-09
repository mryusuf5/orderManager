<div class="modal fade" id="productModal-{{$id}}" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form action="{{$route}}" method="post">
            @csrf
            @method('post')
            <input type="text" name="product_id" hidden value="{{$id}}">
            <input type="text" name="table" hidden value="{{$table}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTitle">{{$title}} - {{$price}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <img src="{{$image}}" class="w-100">
                    @if(strlen($description) > 0)
                        <hr>
                        <p>{{$description}}</p>
                    @endif
                    <hr>
                    <h5>Sauzen @if($settings->free_sauces > 0) ({{$settings->free_sauces}} gratis) @endif</h5>
                    @foreach($sauces as $sauce)
                        <div class="form-check">
                            <input class="form-check-input sauceCheckbox" name="sauce[]" type="checkbox"
                                   value="{{$sauce->name}}">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{$sauce->name}} - &euro; {{number_format($sauce->price, 2, ',', '.')}}
                            </label>
                        </div>
                    @endforeach
                    <hr>
                    <div class="form-floating">
                        <textarea name="remark" class="form-control" placeholder="Opmerking" cols="30" rows="10"></textarea>
                        <label>Opmerking</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Toevoegen</button>
                </div>
            </div>
        </form>
    </div>
</div>
