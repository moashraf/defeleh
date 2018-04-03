<table class="table table-responsive" id="profiles-table">
    <thead>
        <tr>
        <th>Userid</th>
        <th>Fullname</th>
        <th>Cellphone</th>
        <th>Profileimage</th>
        <th>Role</th>
        <th>Address</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($profiles as $profile)
        <tr>
            <td>{!! $profile->userid !!}</td>
            <td>{!! $profile->fullname !!}</td>
            <td>{!! $profile->cellphone !!}</td>
            <td><img src="{{asset('/images/').'/'.$profile->profileimage}}" alt="" width="60" height="50" class="img img-circle"></td>
            <td>{!! $profile->user_role == 1 ? 'Admin' : 'User' !!}</td>
            <td>{!! $profile->address !!}</td>
            <td>
                {!! Form::open(['route' => ['profiles.destroy', $profile->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('profiles.show', [$profile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('profiles.edit', [$profile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>