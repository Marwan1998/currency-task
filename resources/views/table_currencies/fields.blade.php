<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 7,'maxlength' => 7]) !!}
</div>

<!-- Pic Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pic', 'Pic:') !!}
    {!! Form::text('pic', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>