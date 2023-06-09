<x-admin.layout>
    <x-slot name="title">{{$product->name}}</x-slot>
    <x-slot name="backButtonRoute">{{route('admin.productcategories.edit', $product->category_id)}}</x-slot>

    <form action="{{route('admin.products.update', $product->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Image</label>
            <br>
            <img height="300" width="300" class="object-fit-cover" src="{{asset('img/product/' . $product->image)}}" alt="">
            <input type="file" class="form-control" name="image">
        </div>
        <br>
        <div class="form-floating">
            <input type="text" class="form-control" name="name" value="{{$product->name}}" placeholder="Name">
            <label>Name</label>
        </div>
        <br>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" placeholder="Description" cols="30" rows="10">{{$product->description}}</textarea>
        </div>
        <br>
        <div class="form-floating">
            <input type="text" value="{{$product->price}}" class="form-control" name="price">
            <label>Price</label>
        </div>
        <br>
        <div class="form-floating">
            <input type="text" value="{{$product->stock}}" class="form-control" name="stock">
            <label>Stock</label>
        </div>
        <br>
        <input type="submit" class="btn btn-primary">
    </form>
    <br>
    <form action="{{route('admin.productcategories.destroy', $product->id)}}" class="confirmForm" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete" class="btn btn-danger">
    </form>
</x-admin.layout>
