@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h2>Edit Profile For user : {{Auth::user()->name}}</h2>
<center>


    <form action="{{route('user-profile.update',$profile->id)}}" method="post" enctype="multipart/form-data">
        Full name : <input type="text" name="fullname" value="{{$profile->fullname}}" required><br><br>
        Phone : <input type="text" name="cellphone" value="{{$profile->cellphone}}" required><br><br>
        <div style="display: inline-block">
            <div style="float:left">
                Profile Image : <input type="file" name="profileimage"><br><br>
            </div>
            <div style="float: right">
                <img src="{{ $profile->profileimage ? asset('/images/'.$profile->profileimage) : 'https://i.imgur.com/hcfD4VM.png'}}" alt="" width="80" height="60">
            </div>
        </div>
        <br><br>
        Address : <input type="text" name="address" value="{{$profile->address}}" required><br><br>
        <button type="submit">Update</button>
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form>


</center>