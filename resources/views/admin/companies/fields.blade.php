<!-- Ownerid Field -->
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('ownerid', 'Ownerid:') !!}--}}
    {{--{!! Form::number('ownerid', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

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

<!-- Categoryid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('categoryid', 'Categoryid:') !!}
    <select name="categoryid" class="form-control">
        @foreach(App\Models\companycategory::all() as $category)
            <option value="{{$category->id}}"> {{$category->name}} </option>
        @endforeach
    </select>
    {{--{!! Form::number('categoryid', null, ['class' => 'form-control']) !!}--}}
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
