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
         </tr>
    </thead>
    <tbody>
    @foreach($companies as $company)
        <tr> 
            <td>{!! $company->ownerid !!}</td>
            <td>{!! $company->name !!}</td>
            <td>{!! $company->image !!}</td>
            <td>{!! $company->categoryid !!}</td>
            <td>{!! $company->address !!}</td>
            <td>{!! $company->phones !!}</td>
            <td>{!! $company->description !!}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>