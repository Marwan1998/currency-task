<!-- Users Field -->
<div class="form-group col-sm-12">
    {!! Form::label('user', 'User:') !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Roles Field -->
<div class="form-group col-sm-12">
    {!! Form::label('role', 'Role:') !!}
    {!! Form::select('role_id', $roles, null, ['class' => 'form-control custom-select']) !!}
</div>


