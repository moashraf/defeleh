<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control' , 'required' => 'required' ]) !!}
</div>

<!-- Parentid Field -->
<div class="form-group col-sm-4">
    {!! Form::label('parentid', 'Parent :') !!}
 
       <select name ="parentid"   class  = 'form-control' >
                           <option  selected = selected value="0">main </option>

                  @foreach($companies_cat as $company_val)
                  <option   
                  
                   value="{{ $company_val->id }}">{{ $company_val->name  }} 
                  </option>
                  @endforeach
               </select>

</div>
 <div class="form-group col-sm-4">
               {!! Form::label('image', 'Image:') !!}
               <input  type="file"  class="form-control"   name="image" required="required"   >
            </div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('companycategories.index') !!}" class="btn btn-default">Cancel</a>
</div>
