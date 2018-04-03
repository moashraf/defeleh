<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Companyid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('companyid', 'Companyid:') !!}
    {!! Form::number('companyid', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Fabric Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('fabric', 'Fabric:') !!}
    {!! Form::text('fabric', null, ['class' => 'form-control']) !!}
</div>

<!-- Least Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('least', 'Least:') !!}
    {!! Form::number('least', null, ['class' => 'form-control']) !!}
</div>

<!-- Colors Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('colors', 'Colors:') !!}
    {!! Form::text('colors', null, ['class' => 'form-control']) !!}
</div>

<!-- Images Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('images', 'Images:') !!}
    <input type="file" name="images[]"  multiple>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">Cancel</a>
</div>
