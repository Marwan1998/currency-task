<!-- Users Field -->
<div class="form-group col-sm-12">
    {!! Form::label('user', 'User:') !!}
    {!! Form::select('users', $users, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Roles Field -->
<div class="form-group col-sm-12">
    {!! Form::label('role', 'Role:') !!}
    {!! Form::select('roles', $roles, null, ['class' => 'form-control custom-select']) !!}
</div>


