<!-- Guard Field -->
<div class="form-group col-sm-12">
    {!! Form::label('user', 'User:') !!}
    {!! Form::select('user', ['web' => 'web', 'api' => 'api'], null, ['class' => 'form-control custom-select']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('role', 'Role:') !!}
    {!! Form::select('role', ['web' => 'web', 'api' => 'api'], null, ['class' => 'form-control custom-select']) !!}
</div>