@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h2>Create Profile For user : {{$user->name}}</h2>
<center>


    <form action="{{route('user-profile.store')}}" method="post" enctype="multipart/form-data">
        Full name : <input type="text" name="fullname" required><br><br>
        Phone : <input type="text" name="cellphone" required><br><br>
        Profile Image : <input type="file" name="profileimage"><br><br>
        Address : <input type="text" name="address" required><br><br>
        <button type="submit">Create</button>
        {{csrf_field()}}
    </form>


</center>