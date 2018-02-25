<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $comment->id !!}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{!! $comment->content !!}</p>
</div>

<!-- Ownerid Field -->
<div class="form-group">
    {!! Form::label('ownerid', 'Ownerid:') !!}
    <p>{!! $comment->ownerid !!}</p>
</div>

<!-- Postid Field -->
<div class="form-group">
    {!! Form::label('postid', 'Postid:') !!}
    <p>{!! $comment->postid !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $comment->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $comment->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $comment->deleted_at !!}</p>
</div>

