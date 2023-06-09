<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; max-height: 100%; min-height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Order manager</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{route('admin.orders.index')}}" class="nav-link text-white {{Route::is('admin.orders.index')
                     || Route::is('admin.orders.edit')? 'active' : ''}}" aria-current="page">
                <i class="fa-solid fa-pen me-2"></i>
                Bestellingen
            </a>
        </li>
        <li>
            <a href="{{route('admin.productcategories.index')}}" class="nav-link text-white
            {{Route::is('admin.productcategories.index')
            || Route::is('admin.productcategories.edit')
            || Route::is('admin.products.edit') ? 'active' : ''}}">
                <i class="fa-solid fa-layer-group me-2"></i>
                Product categorieën
            </a>
        </li>
{{--        <li>--}}
{{--            <a href="{{route('admin.ingredients.index')}}" class="nav-link text-white--}}
{{--            {{Route::is('admin.ingredients.index') ? 'active' : ''}}">--}}
{{--                <i class="fa-solid fa-carrot me-2"></i>--}}
{{--                Ingredients--}}
{{--            </a>--}}
{{--        </li>--}}
        <li>
            <a href="{{route('admin.sauces.index')}}" class="nav-link text-white
            {{Route::is('admin.sauces.index') ? 'active' : ''}}">
                <i class="fa-solid fa-jar me-2"></i>
                Sauzen
            </a>
        </li>
        <li>
            <a href="{{route('admin.tables.index')}}" class="nav-link text-white
            {{Route::is('admin.tables.index') || Route::is('admin.tables.edit') ? 'active' : ''}}">
                <i class="fa-solid fa-chair me-2"></i>
                Tafels
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
           data-bs-toggle="dropdown" aria-expanded="false">
            <strong>{{Session::get('admin')->username}}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li>
                <a class="dropdown-item" href="{{route('admin.settings')}}">Instellingen</a>
                <form action="{{route('admin.logout')}}" method="post">
                    @csrf
                    @method('POST')
                    <button class="dropdown-item" type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>
