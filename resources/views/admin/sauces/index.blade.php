<x-admin.layout>
    <br>
    <br>
    <x-slot name="title">Sauzen</x-slot>
    <x-slot name="target">newSauce</x-slot>
    <x-slot name="addButton">Nieuwe saus</x-slot>

    <div class="row g-0 gap-2 justify-content-center">
        @foreach($sauces as $sauce)
            <x-admin.card>
                <x-slot name="title">{{$sauce->name}} - &euro; {{number_format($sauce->price, 2, ',', '.')}}</x-slot>
                <x-slot name="class"></x-slot>
                <x-slot name="image">{{asset('img/sauce/' . $sauce->image)}}</x-slot>
                <x-slot name="route">{{route('admin.sauces.edit', $sauce->id)}}</x-slot>
            </x-admin.card>
        @endforeach
    </div>

    <x-admin.new-modal>
        <x-slot name="id">newSauce</x-slot>
        <x-slot name="route">{{route('admin.sauces.store')}}</x-slot>
        <x-slot name="title">Saus</x-slot>
        <div class="form-floating">
            <input type="text" placeholder="Naam" name="name" class="form-control">
            <label>Naam<span class="text-danger">*</span></label>
        </div>
        <br>
        <div class="form-floating">
            <input type="text" placeholder="Prijs" name="price" class="form-control">
            <label>Prijs<span class="text-danger">*</span></label>
        </div>
        <br>
        <div class="form-group">
            <label>Foto</label>
            <input type="file" name="image" class="form-control">
        </div>
    </x-admin.new-modal>
</x-admin.layout>
