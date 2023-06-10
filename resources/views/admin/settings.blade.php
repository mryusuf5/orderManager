@php
    $themes = [
        'cerulean',
        'cosmo',
        'cyborg',
        'darkly',
        'flatly',
        'journal',
        'litera',
        'lumen',
        'lux',
        'materia',
        'minty',
        'morph',
        'pulse',
        'quartz',
        'sandstone',
        'simplex',
        'sketchy',
        'slate',
        'solar',
        'spacelab',
        'superhero',
        'united',
        'vapor',
        'yeti',
        'zephyr'
];
@endphp
<x-admin.layout>
    <x-slot name="title">Instellingen</x-slot>

    <form action="{{route('admin.settingsPost')}}" method="post">
        @csrf
        @method('POST')
        <div class="form-floating">
            <input type="text" value="{{$settings->free_sauces}}" name="free_sauces"
                   placeholder="Gratis sauzen per bestelling" class="form-control">
            <label>Gratis sauzen per bestelling</label>
        </div>
        <br>
        <div class="form-group">
            <label>Thema:</label>
            <select name="style" class="form-control">
                @foreach($themes as $theme)
                    <option value="{{$theme}}" @if($theme === $settings->style) selected @endif>{{$theme}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <input type="submit" value="Opslaan" class="btn btn-primary">
    </form>
</x-admin.layout>
