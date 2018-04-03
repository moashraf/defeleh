<section class="content-header">
   <h1>
      Company
   </h1>
</section>
<div class="content">
   @include('adminlte-templates::common.errors')
   <div class="box box-primary">
      <div class="box-body">
         <div class="row">
       {!! Form::model($company, ['route' => ['mainCompanies.update', $company->id], 'method' => 'patch']) !!}

            <!-- Name Field -->
            <div class="form-group col-sm-6">
               {!! Form::label('name', 'Name:') !!}
               {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <!-- Image Field -->
            <div class="form-group col-sm-12 col-lg-12">
               {!! Form::label('image', 'Image:') !!}
               <input  type="file"  accept="image/x-png,image/gif,image/jpeg" class="form-control"   name="image" required="required"   >
            </div>
            <!-- Categoryid Field -->
            <div class="form-group col-sm-6">
               <select name ="categoryid">
                  @foreach($companies_cat as $companies_cat_val)
                  <option  value="{{ $companies_cat_val->id }}"  
                    @if (  $companies_cat_val->id==$company->categoryid ) {!  selected='selected' !}  @endif >
                    {{ $companies_cat_val->name   }}</option>
                  @endforeach
               </select>
            </div>
            <!-- Address Field -->
            <div class="form-group col-sm-12 col-lg-12">
               {!! Form::label('address', 'Address:') !!}
               {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
            </div>
            <!-- Phones Field -->
            <div class="form-group col-sm-12 col-lg-12">
               {!! Form::label('phones', 'Phones:') !!}
               {!! Form::textarea('phones', null, ['class' => 'form-control']) !!}
            </div>
            <!-- Description Field -->
            <div class="form-group col-sm-12 col-lg-12">
               {!! Form::label('description', 'Description:') !!}
               {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
            <!-- Submit Field -->
            <div class="form-group col-sm-12">
               {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
               <a href="{!! route('companies.index') !!}" class="btn btn-default">Cancel</a>
            </div>
            {!! Form::close() !!}
         </div>
      </div>
   </div>
</div>