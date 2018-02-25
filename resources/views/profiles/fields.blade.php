<!-- Userid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('userid', 'Userid:') !!}
    {!! Form::number('userid', null, ['class' => 'form-control']) !!}
</div>

<!-- Fullname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fullname', 'Fullname:') !!}
    {!! Form::text('fullname', null, ['class' => 'form-control']) !!}
</div>

<!-- Cellphone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cellphone', 'Cellphone:') !!}
    {!! Form::text('cellphone', null, ['class' => 'form-control']) !!}
</div>

<!-- Profileimage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('profileimage', 'Profileimage:') !!}
    {!! Form::text('profileimage', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role', 'Role:') !!}
    {!! Form::select('user_role', [0 => 'User', 1 => 'Admin'], null, ['placeholder' => 'Select User Type...', 'class' => 'form-control']); !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('profiles.index') !!}" class="btn btn-default">Cancel</a>
</div>
