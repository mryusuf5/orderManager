<x-admin.layout>
    <x-slot name="title">Categorieën</x-slot>
    <x-slot name="addButton">Nieuwe Categorie</x-slot>
    <x-slot name="target">newCategory</x-slot>

    <div class="row g-0 gap-2 justify-content-center">
        @foreach($categories as $category)
            <x-admin.card>
                <x-slot name="route">{{route('admin.productcategories.edit', $category)}}</x-slot>
                <x-slot name="title">{{$category->name}}</x-slot>
                <x-slot name="image">{{asset('img/category/' . $category->image)}}</x-slot>
            </x-admin.card>
        @endforeach
    </div>

    <x-admin.new-modal>
        <x-slot name="id">newCategory</x-slot>
        <x-slot name="route">{{route('admin.productcategories.store')}}</x-slot>
        <x-slot name="title">Categorie</x-slot>
        <div class="form-group">
            <label>Naam<span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="Name">
        </div>
        <br>
        <div class="form-group">
            <label>Omschrijving</label>
            <textarea name="description" cols="30" rows="10" class="form-control" placeholder="Description"></textarea>
        </div>
        <br>
        <div class="form-group">
            <label>Foto</label>
            <input type="file" name="image" class="form-control">
        </div>
    </x-admin.new-modal>
</x-admin.layout>
