<h2>Profile of {{Auth::user()->name}}</h2>

@if(Auth::user()->isAdmin())
    <a href='{{url('/admin')}}'> Admin Area .. </a>
@endif

<center>
    full name : {{ $profile->fullname }} <br><br>
    phone : {{ $profile->cellphone }} <br><br>
    image : <img src="{{ $profile->profileimage ? asset('/images/'.$profile->profileimage) : 'https://i.imgur.com/hcfD4VM.png'}}" alt="" width="80" height="60"> <br><br>
    address : {{ $profile->address }} <br><br>

    <br><br><br><br><a href="{{route('user-profile.edit',$profile->id)}}">EDIT</a>
</center>