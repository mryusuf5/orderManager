<x-admin.layout>
    <x-slot name="title">{{$table->name}}</x-slot>
    <x-slot name="backButtonRoute">{{route('admin.tables.index')}}</x-slot>

    {!! QrCode::size(600)->generate($table->url) !!}
    <br>
    <br>
    <a href="#" class="btn btn-primary">Print Qr code</a>
    <br>
    <br>
    <form action="{{route('admin.tables.update', $table->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-floating">
            <input type="text" class="form-control" name="name" value="{{$table->name}}" placeholder="Tafel naam">
            <label>Tafel naam</label>
        </div>
        <br>
        <input type="submit" class="btn btn-primary" value="Opslaan">
    </form>
    <br>
    <form action="{{route('admin.tables.destroy', $table->id)}}" class="confirmForm" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete" class="btn btn-danger">
    </form>
</x-admin.layout>
