<!-- Currency Id Field -->
<div class="col-sm-12">
    {!! Form::label('currency_id', 'Currency Id:') !!}
    <p>{{ $currenciesInfo->currency_id }}</p>
</div>

<!-- Value Field -->
<div class="col-sm-12">
    {!! Form::label('value', 'Value:') !!}
    <p>{{ $currenciesInfo->value }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $currenciesInfo->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $currenciesInfo->updated_at }}</p>
</div>

