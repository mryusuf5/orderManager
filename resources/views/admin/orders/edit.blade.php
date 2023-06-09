<x-admin.layout>
    <x-slot name="title">Tafel {{$orders[0]->table_name}}</x-slot>
    <x-slot name="backButtonRoute">{{route('admin.orders.index')}}</x-slot>

    <div class="row g-0 gap-2 justify-content-center">
        @foreach($orders as $order)
            <x-admin.order-card>
                <x-slot name="title">{{$order->name}}</x-slot>
                <x-slot name="image">{{asset('img/product/' . $order->image)}}</x-slot>
                <x-slot name="description">{{$order->description}}</x-slot>
                <x-slot name="remark">{{$order->remark}}</x-slot>
                <x-slot name="sauces">{{str_replace(',', ' - ', $order->sauces)}}</x-slot>
                <x-slot name="price">&euro; {{number_format($order->price, 2, ',', '.')}}</x-slot>
            </x-admin.order-card>
        @endforeach
        <div class="d-flex justify-content-between col-10">
            <h3>Totale prijs: &euro; {{number_format($totalPrice, 2, ',', '.')}}</h3>
            <form action="{{route('admin.orderPaid', $order->table_id)}}" method="post" id="confirmPaid">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-success">Klant heeft betaald</button>
            </form>
        </div>
    </div>

    @section('adminScripts')
        <script>
            const form = document.querySelector('#confirmPaid');
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                Swal.fire({
                    title: 'Weet je zeker dat de klant betaald heeft?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ja',
                    cancelButtonText: 'Nee'
                }).then(result => {
                    if(result.isConfirmed)
                    {
                        form.submit();
                    }
                });
            })
        </script>
    @endsection
</x-admin.layout>
