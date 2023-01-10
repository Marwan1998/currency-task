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

<!-- permissions Fields -->
@foreach ($permissions as $permission)
    <div class="form-group col-sm-4">
        {!! Form::checkbox('permission_'.$permission->name, $permission->id) !!}
        {!! Form::label($permission->name, $permission->name) !!}
    </div>
@endforeach