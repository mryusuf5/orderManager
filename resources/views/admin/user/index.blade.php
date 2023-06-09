@if($message = Session::get('error'))
    <span style="color: red">{{$message}}</span>
    <hr>
@endif

<form action="{{route('login')}}" method="post">
    @csrf
    @method('POST')
    <label>Gebruikersnaam</label>
    <input type="text" name="username">
    <br>
    <label>wachtwoord</label>
    <input type="password" name="password">
    <br>
    <input type="submit">
</form>
