<table class="table table-responsive" id="companies-table">
         @include('flash::message')

    <thead>
        <tr>
            <th>Ownerid</th>
        <th>Name</th>
        <th>Image</th>
        <th>Categoryid</th>
        <th>Address</th>
        <th>Phones</th>
        <th>Description</th>
        <th>ac</th>
         </tr>
    </thead>
    <tbody>
    @foreach($companies as $company)
        <tr>
            <td>{!! $company->ownerid !!}</td>
            <td>{!! $company->name !!}</td>
            <td>{!! $company->image !!}</td>
            <td>{!! $company->get_company_cat->name !!}</td>
            <td>{!! $company->address !!}</td>
            <td>{!! $company->phones !!}</td>
            <td>{!! $company->description !!}</td>
            
         <td>
                {!! Form::open(['route' => ['mainCompanies.destroy', $company->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('mainCompanies.show', [$company->id]) !!}"  ><i class="glyphicon glyphicon-eye-open"></i>show</a>
                    <a href="{!! route('mainCompanies.edit', [$company->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i>edit</a>
                    {!! Form::button('d', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>


    @endforeach
    </tbody>
         {{ $companies->links() }}

</table>