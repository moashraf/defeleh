<table class="table table-responsive" id="companies-table">
    <thead>
        <tr>
            <th>Ownerid</th>
        <th>Name</th>
        <th>Image</th>
        <th>Categoryid</th>
        <th>Address</th>
        <th>Phones</th>
        <th>Description</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($companies as $company)
        <tr>
            <td>{!! $company->ownerid !!}</td>
            <td>{!! $company->name !!}</td>
            <td><img src="{{asset('/images/').'/'.$company->image}}" alt="" width="60" height="50" class="img img-circle"> </td>
            <td>{!! $company->categoryid !!}</td>
            <td>{!! $company->address !!}</td>
            <td>{!! $company->phones !!}</td>
            <td>{!! $company->description !!}</td>
            <td>
                {!! Form::open(['route' => ['companies.destroy', $company->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('companies.show', [$company->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('companies.edit', [$company->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>