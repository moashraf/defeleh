<table class="table table-responsive" id="companycategories-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Parentid</th>
        <th>Image</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($companycategories as $companycategory)
        <tr>
            <td>{!! $companycategory->name !!}</td>
            <td>{!! $companycategory->parentid !!}</td>
   <td>  <img src="{{ URL::to('').'/images/'.$companycategory->image  }}"   height="100" width="150">  </td>

            <td>
                {!! Form::open(['route' => ['companycategories.destroy', $companycategory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('companycategories.show', [$companycategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('companycategories.edit', [$companycategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>