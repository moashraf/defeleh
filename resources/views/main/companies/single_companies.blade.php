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
         <tr>
            <td>{!! $company->get_company_user->name !!}</td>
            <td>{!! $company->name !!}</td>
             <td>  <img src="{{ URL::to('').'/upload/'.$company->image  }}"   height="100" width="150">  </td>
            <td>{!! $company->get_company_cat->name !!}</td>
            <td>{!! $company->address !!}</td>
            <td>{!! $company->phones !!}</td>
            <td>{!! $company->description !!}</td>
            
        </tr>
     </tbody>
</table>

    <br><br><br><br><br> -----------jobs ----------<br><br><br><br><br><br>


               @foreach($company->get_company_jobs as $company_val)
<br>
            <td>{!!  $company_val->title!!}</td>
            <td>{!!  $company_val->content!!}</td>
            <td>{!!  $company_val->contact!!}</td>
      
    @endforeach
   <br><br><br><br><br> -----------products ----------<br><br><br><br><br><br>
    

      @foreach($company->get_company_products as $company_val)
<br>
            <td>{!!  $company_val->name!!}</td><br>
  <td>  <img src="{{ URL::to('').'/upload/'.$company_val->image  }}"   height="100" width="150">  </td>
            <td>{!!  $company_val->description!!}</td><br>
            <td>{!!  $company_val->price!!}</td><br>
            <td>{!!  $company_val->fabric!!}</td><br>
            <td>{!!  $company_val->least!!}</td><br>
            <td>{!!  $company_val->colors!!}</td><br>
            -----------------
       
    @endforeach

    <br><br><br><br><br> ----------------- post ------------ <br><br><br><br><br>
        @foreach($company->get_company_post as $company_val)
<br>
            <td>{!!  $company_val->name!!}</td><br>
  <td>  <img src="{{ URL::to('').'/upload/'.$company_val->image  }}"   height="100" width="150">  </td>
            <td>{!!  $company_val->title!!}</td><br>
            <td>{!!  $company_val->content!!}</td><br>
            <td>{!!  $company_val->ownertype    !!}</td><br>
      
            -----------------
       
    @endforeach
