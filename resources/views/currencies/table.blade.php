{{-- <div class="table-responsive">
    <table class="table" id="currencies-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Value</th>
            <th>Pic</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($currencies as $currencies)
            <tr>
                <td>{{ '1 '.$currencies->name }}</td>
                <td>{{ $currencies->currencies->value.' LD' }}</td>
                <td class="w-25">
                    <img class="img-fluid img-thumbnail rounded w-25" src="/storage/flags/{{ $currencies->pic }}" alt="{{ $currencies->pic }}">
                </td>
                <td width="120">
                    {!! Form::open(['route' => ['currencies.destroy', $currencies->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('currencies.show', [$currencies->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('currencies.edit', [$currencies->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div> --}}
@push('third_party_stylesheets')
    @include('layouts.datatables_css')
@endpush

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

@push('third_party_scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush