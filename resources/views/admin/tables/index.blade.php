<x-admin.layout>
    <br>
    <br>
    <x-slot name="title">Tables</x-slot>
    <x-slot name="target">newTable</x-slot>
    <x-slot name="addButton">Nieuwe tafel</x-slot>

    <div class="row g-0 gap-2 justify-content-center">
        @foreach($tables as $table)
            <x-admin.card>
                <x-slot name="title">{{$table->name}}</x-slot>
                <x-slot name="class"></x-slot>
                <x-slot name="route">{{$table->url}}</x-slot>
                <x-slot name="userRoute">{{$table->qr_code}}</x-slot>
            </x-admin.card>
        @endforeach
    </div>

    <x-admin.new-modal>
        <x-slot name="id">newTable</x-slot>
        <x-slot name="route">{{route('admin.tables.store')}}</x-slot>
        <x-slot name="title">Tafel</x-slot>
        <div class="form-floating">
            <input type="text" placeholder="Naam" name="name" class="form-control">
            <label>Naam<span class="text-danger">*</span></label>
        </div>
    </x-admin.new-modal>
</x-admin.layout>
