<x-user.layout>
    @php
        $totalPrice = 0;
    @endphp
    <br>
    <br>
    <br>
    <button data-bs-target="#ordersModal" data-bs-toggle="modal" class="btn btn-primary rounded-pill ordersButton p-0">
        {{count($orders) ?? '0'}}
    </button>
    <div class="d-flex gap-2 py-2 mt-2 container overflow-auto buttonsContainer">
        @foreach($categories as $category)
            <a href="#{{$category->name}}" class="btn btn-primary rounded-pill categoryButton">{{$category->name}}</a>
        @endforeach
    </div>
    @foreach($categories as $index => $category)
        @if($index != 0)
            <hr>
        @endif
        <h1 class="p-2">{{$category->name}}</h1>
        <div class="row g-0 justify-content-center" id="{{$category->name}}">
        @foreach($category->products as $product)
            <x-user.card>
                <x-slot name="title">{{$product->name}}</x-slot>
                <x-slot name="image">{{asset('img/product/' . $product->image)}}</x-slot>
                <x-slot name="id">{{$product->id}}</x-slot>
            </x-user.card>
            <x-user.product-modal :sauces="$sauces" :supplements="$supplements">
                <x-slot name="title">{{$product->name}}</x-slot>
                <x-slot name="id">{{$product->id}}</x-slot>
                <x-slot name="image">{{asset('img/product/' . $product->image)}}</x-slot>
                <x-slot name="description">{{$product->description}}</x-slot>
                <x-slot name="price">&euro; {{number_format($product->price, 2, ',', '.')}}</x-slot>
                <x-slot name="route">{{route('ordersStore', $table->id)}}</x-slot>
                <x-slot name="table">{{$table->id}}</x-slot>
            </x-user.product-modal>
        @endforeach
        </div>
    @endforeach
    @section('userStyles')
        <style>
            .buttonsContainer{
                overflow: auto;
                white-space: nowrap;
                position: fixed;
                z-index: 1;
                background: var(--bs-body-bg);
                top: -10px;
            }

            .categoryButton{
                display: inline-block;
                width: auto;
                /*height: 40px;*/
            }

            .ordersButton{
                height: 50px;
                width: 50px;
                position: fixed;
                bottom: 2%;
                right: 2%;
                z-index: 2;
            }
        </style>
    @endsection

    @section('userScripts')
        <script>
            @if($message = Session::get('success'))
                Toastify({
                    text: "{{$message}}",
                    className: "info",
                    gravity: "top",
                    position: "center",
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    }
                }).showToast();
            @endif

            const orderForm = document.querySelector('#orderForm');
            orderForm.addEventListener('submit', (e) => {
                e.preventDefault();
                Swal.fire({
                    title: 'Heb je alles geselecteerd en ben je klaar voor je bestelling?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Ja',
                    cancelButtonText: 'Nee'
                }).then(result => {
                    if(result.isConfirmed)
                    {
                        orderForm.submit();
                    }
                });
            })
        </script>
    @endsection
    <div class="modal fade" id="ordersModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Bestellingen ({{count($orders) ?? 0}})</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column align-items-center gap-2">
                    @foreach($orders as $order)
                        @php
                            $totalPrice += $order->price;
                            $saucesOrder = explode(',', $order->sauces);
                            $supplementsOrder = explode(',', $order->supplements)
                        @endphp

                        @foreach($supplements as $supplement)
                            @foreach($supplementsOrder as $supplementOrder)
                                @if($supplement->name == $supplementOrder)
                                    @php
                                        $totalPrice += $supplement->price;
                                    @endphp
                                @endif
                            @endforeach
                        @endforeach

                        @if(count($saucesOrder) > $settings->free_sauces)
                            @foreach($saucesOrder as $index => $sauceOrder)
                                @if($index + 1 > $settings->free_sauces)
                                    @foreach($sauces as $sauce)
                                        @if($sauce->name === $sauceOrder)
                                            @php
                                                $totalPrice += $sauce->price;
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                        <x-user.card>
                            <x-slot name="image">{{asset('img/product/' . $order->image)}}</x-slot>
                            <x-slot name="title">{{$order->name}} - &euro;
                                {{number_format($order->price, 2, ',', '.')}}</x-slot>
                            <x-slot name="route">{{route('ordersDestroy', $order->id)}}</x-slot>
                            <p class="p-2">{{$order->description}}</p>
                            <p class="p-2">{{$order->remark}}</p>
                            @foreach($saucesOrder as $sauce)
                                <span class="p-2">{{$sauce}} </span>
                            @endforeach
                        </x-user.card>
                    @endforeach
                </div>
                <div class="container">
                    Totaal prijs: &euro; {{number_format($totalPrice, 2, ',', '.')}}
                </div>
                <div class="modal-footer">
                    <form action="{{route('orderUpdate', $table->id)}}" method="post" id="orderForm">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-primary">Bestellen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-user.layout>
