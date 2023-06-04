@if($message = Session::get('error'))
    <span style="color: red">{{$message}}</span>
    <hr>
@endif

<form action="{{route('login')}}" method="post">
    @csrf
    @method('POST')
    <label>Username</label>
    <input type="text" name="username">
    <br>
    <label>Password</label>
    <input type="password" name="password">
    <br>
    <input type="submit">
</form>
