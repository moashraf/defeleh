<!-- Userid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('userid', 'Userid:') !!}
    {!! Form::number('userid', null, ['class' => 'form-control']) !!}
</div>

<!-- Postid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('postid', 'Postid:') !!}
    {!! Form::number('postid', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('likes.index') !!}" class="btn btn-default">Cancel</a>
</div>
