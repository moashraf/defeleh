<h2>Profile of {{Auth::user()->name}}</h2>

@if(Auth::user()->isAdmin())
    <a href='{{url('/admin')}}'> Admin Area .. </a>
@endif
<center>
@if(!empty(Auth::user()->profile))


        full name : {{ Auth::user()->profile->fullname }} <br><br>
        phone : {{ Auth::user()->profile->cellphone }} <br><br>
        image : <img src="{{ Auth::user()->profile->profileimage != null ? asset('/images/'.Auth::user()->profile->profileimage) : 'https://i.imgur.com/hcfD4VM.png'}}" alt="" width="80" height="60"> <br><br>
        address : {{ Auth::user()->profile->address }} <br><br>

@else

    user don't have profile , <a href="{{route('user-profile.create')}}"> Update Your Profile now .. </a>

@endif
</center>