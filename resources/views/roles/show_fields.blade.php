<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $role->name }}</p>
</div>

<!-- Guard Field -->
<div class="col-sm-12">
    {!! Form::label('guard', 'Guard:') !!}
    <p>{{ $role->guard_name }}</p>
</div>

<!-- permissions Fields -->
<div class="form-group col-sm-12">
    {!! Form::label('permissions', 'Permissions:') !!}
    @foreach ($permissions as $permission)
        <p>{{ $permission }}</p>
    @endforeach
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $role->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $role->updated_at }}</p>
</div>

