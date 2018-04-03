<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $product->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $product->name !!}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <p><img src="{{asset('images/').'/'.$product->image}}" alt="" width="150" height="120"> </p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $product->description !!}</p>
</div>

<!-- Companyid Field -->
<div class="form-group">
    {!! Form::label('companyid', 'Companyid:') !!}
    <p>{!! $product->companyid !!}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{!! $product->price !!}</p>
</div>

<!-- Fabric Field -->
<div class="form-group">
    {!! Form::label('fabric', 'Fabric:') !!}
    <p>{!! $product->fabric !!}</p>
</div>

<!-- Least Field -->
<div class="form-group">
    {!! Form::label('least', 'Least:') !!}
    <p>{!! $product->least !!}</p>
</div>

<!-- Colors Field -->
<div class="form-group">
    {!! Form::label('colors', 'Colors:') !!}
    <p>{!! $product->colors !!}</p>
</div>

<!-- Images Field -->
<div class="form-group">
    {!! Form::label('images', 'Images:') !!}
    @foreach($product->images as $image)
        <p><img src="{{asset('images/').'/'.$image}}" alt="" width="150" height="120"> </p>
    @endforeach


</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $product->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $product->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $product->deleted_at !!}</p>
</div>

