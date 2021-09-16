<div>
    <form action="{{route('resetPass')}}" method="post">
        @csrf
        <input type="text" hidden name="token" value="{{$token}}">
        <input type="password" name="password">
        <button type="submit">accept</button>
    </form>
</div>
