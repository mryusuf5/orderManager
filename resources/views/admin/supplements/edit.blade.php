<x-admin.layout>
    <x-slot name="title">{{$supplement->name}}</x-slot>
    <x-slot name="backButtonRoute">{{route('admin.supplements.index')}}</x-slot>

    <form action="{{route('admin.supplements.update', $supplement->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-floating">
            <input type="text" class="form-control" name="name" value="{{$supplement->name}}" placeholder="Supplement naam">
            <label>Supplement naam</label>
        </div>
        <br>
        <div class="form-floating">
            <input type="text" class="form-control" name="price" value="{{$supplement->price}}" placeholder="Prijs">
            <label>Prijs</label>
        </div>
        <br>
        <input type="submit" class="btn btn-primary" value="Opslaan">
    </form>
    <br>
    <form action="{{route('admin.supplements.destroy', $supplement->id)}}" class="confirmForm" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Verwijderen" class="btn btn-danger">
    </form>
</x-admin.layout>
