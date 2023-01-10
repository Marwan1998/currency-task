<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Guard Field -->
<div class="form-group col-sm-6">
    {!! Form::label('guard', 'Guard:') !!}
    {!! Form::select('guard', ['web' => 'web', 'api' => 'api'], null, ['class' => 'form-control custom-select']) !!}
</div>
