<!-- Users Field -->
<div class="form-group col-sm-12">
    {!! Form::label('user', "@lang('users.role')") !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Roles Field -->
<div class="form-group col-sm-12">
    {!! Form::label('role', "@lang('users.role')") !!}
    {!! Form::select('role_id', $roles, null, ['class' => 'form-control custom-select']) !!}
</div>


