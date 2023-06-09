@php
    use Illuminate\Support\Facades\URL;
@endphp

{!! QrCode::size(300)->generate(URL::current()) !!}
