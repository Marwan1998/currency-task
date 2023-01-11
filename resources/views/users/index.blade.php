@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Assign Role</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        @include('flash::message')
        {{-- @include('users.swalMesaages') --}}

        <div class="card">
            {!! Form::open(['route' => 'users.store']) !!}
            <div class="card-body">
                <div class="row">
                    @include('users.fields')
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('currencies.index') }}" class="btn btn-default">Cancel</a>
            </div>
            {!! Form::close() !!}
        </div>

        <div class="card">
            {!! Form::open(['route' => 'users.removeRole']) !!}
            <div class="card-body">
                <div class="row">
                    @include('users.fields')
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Remove', ['class' => 'btn btn-danger']) !!}
                <a href="{{ route('currencies.index') }}" class="btn btn-default">Cancel</a>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
@endsection

@push('page_scripts')

    <script type="javascript" src="{{ URL::asset('js/alerts.js') }}"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal("Hello world!");
    </script> --}}

@endpush
