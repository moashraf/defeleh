<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $job->id !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $job->title !!}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{!! $job->content !!}</p>
</div>

<!-- Contact Field -->
<div class="form-group">
    {!! Form::label('contact', 'Contact:') !!}
    <p>{!! $job->contact !!}</p>
</div>

<!-- Companyid Field -->
<div class="form-group">
    {!! Form::label('companyid', ' Company : ') !!}
    <p>{!! $job->get_job_company->name !!}</p>
</div>


