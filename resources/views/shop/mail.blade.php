<div>
    <form action="{{route('sendMail')}}" method="post">
        @csrf
        <label for="">Input your email</label>
        <input type="text" name="email">
        <button type="submit">accept</button>
    </form>
</div>
