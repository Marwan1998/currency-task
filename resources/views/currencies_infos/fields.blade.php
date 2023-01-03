<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
{{-- TODO: add select box here --}}
{{-- //----------------------------// --}}

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Value:') !!}
    {!! Form::number('value', null, ['class' => 'form-control', 'step' => 'any']) !!}
</div>

<!-- Currency Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('currency_id', 'Currency Id:') !!}
    {!! Form::number('currency_id', null, ['class' => 'form-control']) !!}
</div>