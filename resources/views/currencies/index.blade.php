@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-secondary">Currencies</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right ml-1"
                       href="{{ route('currencies.create') }}">
                        Add New
                    </a>
                    <a class="btn btn-primary float-right mr-1"
                        href="{{ route('currenciesInfos.create') }}">
                        Add Update
                    </a>
                </div>

            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('currencies.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

