<x-admin.layout>
    <br>
    <br>
    <x-slot name="title">Supplementen</x-slot>
    <x-slot name="target">newSupplement</x-slot>
    <x-slot name="addButton">Nieuwe supplement</x-slot>

    <div class="row g-0 gap-2 justify-content-center">
        @foreach($supplements as $supplement)
            <x-admin.card>
                <x-slot name="title">{{$supplement->name}} - &euro; {{number_format($supplement->price, 2, ',', '.')}}</x-slot>
                <x-slot name="class"></x-slot>
                <x-slot name="route">{{route('admin.supplements.edit', $supplement->id)}}</x-slot>
            </x-admin.card>
        @endforeach
    </div>

    <x-admin.new-modal>
        <x-slot name="id">newSupplement</x-slot>
        <x-slot name="route">{{route('admin.supplements.store')}}</x-slot>
        <x-slot name="title">Supplement</x-slot>
        <div class="form-floating">
            <input type="text" placeholder="Naam" name="name" class="form-control">
            <label>Naam<span class="text-danger">*</span></label>
        </div>
        <br>
        <div class="form-floating">
            <input type="text" placeholder="Prijs" name="price" class="form-control">
            <label>Prijs<span class="text-danger">*</span></label>
        </div>
    </x-admin.new-modal>
</x-admin.layout>
