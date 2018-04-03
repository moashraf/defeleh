<center>

    <form action="{{route('create-user')}}" method="post">
        name : <input type="text" name="name" required><br><br>
        email : <input type="email" name="email" required><br><br>
        password : <input type="password" name="password" required><br><br>
        <button type="submit">Sign Up</button>
        {{csrf_field()}}
    </form>

</center>