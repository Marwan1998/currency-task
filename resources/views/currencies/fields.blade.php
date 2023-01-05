@php
    $value = isset($value) ? $value : null;
    $oldPic = isset($currencies->pic) ? $currencies->pic : 'Choose Picture';
@endphp
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('values', 'Value:') !!}
    {!! Form::number('value', $value, ['class' => 'form-control', 'step' => 'any']) !!}
</div>
<div class="clearfix"></div>

<!-- Pic Field -->
<div class="form-group col-sm-12">
    {!! Form::label('pic', 'Pic:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('pic', ['class' => 'custom-file-input']) !!}
            {!! Form::label('pic', $oldPic, ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>