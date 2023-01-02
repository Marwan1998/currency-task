<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $currencies->name }}</p>
</div>

<!-- Pic Field -->
<div class="col-sm-12">
    {!! Form::label('pic', 'Pic:') !!}
    <p>{{ $currencies->pic }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $currencies->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $currencies->updated_at }}</p>
</div>

