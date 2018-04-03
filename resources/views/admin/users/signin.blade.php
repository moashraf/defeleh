<center>

    <form action="{{route('logging-user')}}" method="post">
        email : <input type="email" name="email" required><br><br>
        password : <input type="password" name="password" required><br><br>
        <button type="submit">Sign In</button>
        {{csrf_field()}}
    </form>

</center>