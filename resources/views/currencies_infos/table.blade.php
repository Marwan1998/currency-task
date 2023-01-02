<div class="table-responsive">
    <table class="table" id="currenciesInfos-table">
        <thead>
        <tr>
            <th>Currency Id</th>
        <th>Value</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($currenciesInfos as $currenciesInfo)
            <tr>
                <td>{{ $currenciesInfo->currency_id }}</td>
            <td>{{ $currenciesInfo->value }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['currenciesInfos.destroy', $currenciesInfo->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('currenciesInfos.show', [$currenciesInfo->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('currenciesInfos.edit', [$currenciesInfo->id]) }}"
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
</div>
