<x-admin.layout>
    <x-slot name="title">{{$category->name}}</x-slot>
    <x-slot name="backButtonRoute">{{route('admin.productcategories.index')}}</x-slot>

    <form action="{{route('admin.productcategories.update', $category->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-floating">
            <input type="text" class="form-control" name="name" value="{{$category->name}}" placeholder="Table name">
            <label>Categorie naam</label>
        </div>
        <br>
        <input type="submit" class="btn btn-primary" value="Opslaan">
    </form>
    <br>
    <form action="{{route('admin.productcategories.destroy', $category->id)}}" class="confirmForm" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Verwijderen" class="btn btn-danger">
    </form>

    <hr>
    <h3>Producten</h3>
    <a href="#" class="btn btn-primary" data-bs-target="#newProduct" data-bs-toggle="modal">Nieuwe product</a>
    <br>
    <div class="table-responsive" style="min-width: 900px;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>@sortablelink('id', '#')</th>
                    <th>@sortablelink('name', 'Naam')</th>
                    <th>Description</th>
                    <th>@sortablelink('price', 'Prijs')</th>
                    <th>@sortablelink('stock', 'Stock')</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $index => $product)
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img height="50" width="50" class="object-fit-cover"
                                     src="{{asset('img/product/' . $product->image)}}">
                                {{$product->name}}
                            </div>
                        </td>
                        <td>{{Str::limit($product->description, 25)}}</td>
                        <td>&euro; {{number_format($product->price, 2, ',', '.')}}</td>
                        <td>{{$product->stock}}</td>
                        <td>
                            <div class="dropdown">
                                <i class="fa-solid fa-ellipsis-vertical text-primary fs-4" style="cursor: pointer"
                                   data-bs-toggle="dropdown"></i>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{route('admin.products.edit', $product->id)}}" class="dropdown-item">Edit</a>
                                        <form action="{{route('admin.products.destroy', $product->id)}}"
                                              class="confirmForm" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-admin.new-modal>
        <x-slot name="id">newProduct</x-slot>
        <x-slot name="route">{{route('admin.products.store')}}</x-slot>
        <x-slot name="title">New Product</x-slot>

        <input type="text" hidden value="{{$category->id}}" name="category_id">
        <div class="form-floating">
            <input type="text" name="name" class="form-control" placeholder="Name">
            <label>Name<span class="text-danger">*</span></label>
        </div>
        <br>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" cols="30" rows="10" placeholder="Description" class="form-control"></textarea>
        </div>
        <br>
        <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" name="image">
        </div>
        <br>
        <div class="form-floating">
            <input type="text" name="price" class="form-control" placeholder="Price">
            <label>Price<span class="text-danger">*</span></label>
        </div>
        <br>
        <div class="form-floating">
            <input type="text" name="stock" class="form-control" placeholder="Stock">
            <label>Stock</label>
        </div>
    </x-admin.new-modal>
</x-admin.layout>
