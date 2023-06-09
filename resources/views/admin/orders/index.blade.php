<x-admin.layout>
    <x-slot name="title">Bestellingen</x-slot>
        <div class="row g-0 gap-2 justify-content-center" id="ordersContainer">
        </div>
    @section('adminScripts')
        <script>
            const ordersContainer = document.querySelector('#ordersContainer');

            const fillOrdersContainer = async () => {
                let orders = await fetchOrders();
                if(orders.orders.length > 0)
                {
                    orders.orders.forEach((order) => {
                        let orderUrl = '{{route('admin.ordersEdit')}}' + '?id=' + order.table_id
                        var cardDiv = document.createElement('div');
                        cardDiv.className = 'card d-flex col-lg-3 col-md-5 col-10 justify-content-center align-items-center';
                        var cardContent = cardContent = `
                                        <div class="card-content d-flex flex-column gap-2 align-items-center">
                                            <h1>Tafel ${order.name}</h1>
                                            <a href="${orderUrl}" class="btn btn-primary">Bekijken</a>
                                        </div>
                                    `;
                        cardDiv.innerHTML = cardContent;
                        ordersContainer.appendChild(cardDiv);
                    })
                }
                else
                {
                    var content = document.createElement('h1');
                    content.className = 'text-danger';
                    content.innerHTML = 'Nog geen bestellingen';
                    ordersContainer.appendChild(content);
                }
            }

            const fetchOrders = async () => {
                const res = await fetch('{{route('adminOrders')}}');
                return await res.json();
            }
            window.addEventListener('load', async () => {
                await fillOrdersContainer();
                setInterval(async () => {
                    ordersContainer.innerHTML = '';
                    await fillOrdersContainer();
                }, 5000)
            })
        </script>
    @endsection
</x-admin.layout>
