<x-admin.layout>
    <x-slot name="title">{{$sauce->name}}</x-slot>
    <x-slot name="backButtonRoute">{{route('admin.sauces.index')}}</x-slot>

    <form action="{{route('admin.sauces.update', $sauce->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <br>
        <img src="{{asset('img/sauce/' . $sauce->image)}}" alt="">
        <br>
        <br>
        <input type="file" name="image" class="form-control">
        <br>
        <div class="form-floating">
            <input type="text" class="form-control" name="name" value="{{$sauce->name}}" placeholder="Saus naam">
            <label>Saus naam</label>
        </div>
        <br>
        <div class="form-floating">
            <input type="text" class="form-control" name="price" value="{{$sauce->price}}" placeholder="Prijs">
            <label>Prijs</label>
        </div>
        <br>
        <input type="submit" class="btn btn-primary" value="Opslaan">
    </form>
    <br>
    <form action="{{route('admin.sauces.destroy', $sauce->id)}}" class="confirmForm" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Verwijderen" class="btn btn-danger">
    </form>
</x-admin.layout>
