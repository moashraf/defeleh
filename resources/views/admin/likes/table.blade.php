<table class="table table-responsive" id="likes-table">
    <thead>
        <tr>
            <th>Userid</th>
        <th>Postid</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($likes as $like)
        <tr>
            <td>{!! $like->userid !!}</td>
            <td>{!! $like->postid !!}</td>
            <td>
                {!! Form::open(['route' => ['likes.destroy', $like->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('likes.show', [$like->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('likes.edit', [$like->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>