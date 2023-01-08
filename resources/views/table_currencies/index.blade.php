@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Table Currencies</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('tableCurrencies.create') }}">
                        Add New
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
                @include('table_currencies.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('page_scripts')
    <script>
        $(document).ready(function () {

            $('section.content table thead tr th').each(function() {
                if($(this).text() == 'Action'){
                    $(this).addClass('w-25');
                } else {
                    $(this).addClass('w-25 bg-primary');
                }
            });
            
            console.log($('section.content table tbody tr td'));
            // .each(function() {
            //     $(this).addClass('hi');
            // });

        });
    </script>
@endpush

