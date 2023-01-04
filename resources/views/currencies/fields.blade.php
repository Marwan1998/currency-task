<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('values', 'Value:') !!}
    {!! Form::number('value', null, ['class' => 'form-control', 'step' => 'any']) !!}
</div>
<div class="clearfix"></div>

<!-- Pic Field -->
<div class="form-group col-sm-12">
    {!! Form::label('pic', 'Pic:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('pic', ['class' => 'custom-file-input']) !!}
            {!! Form::label('pic', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>