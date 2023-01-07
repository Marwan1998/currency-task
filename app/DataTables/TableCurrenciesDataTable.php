<?php

namespace App\DataTables;

use App\Models\TableCurrencies;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Barryvdh\Debugbar\Facades\Debugbar;

class TableCurrenciesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        $dataTable->addColumn('action', 'table_currencies.datatables_actions');

        $dataTable->editColumn('pic', function ($currency) {
            return '<img class="img-fluid img-thumbnail rounded w-25" src="/storage/flags/'.$currency->pic.'" alt='.$currency->name.'>';
        })
        ->escapeColumns([])
        ->make(true);



        // $dataTable->setRowId(function ($currency) {
        //     return $currency->id;
        // });

        // $dataTable->setRowClass('alert-success');

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TableCurrencies $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TableCurrencies $model)
    {
        return $model->newQuery()->with('currencies');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            // ->columnDefs(['className' => 'my_class', 'targets' => '_all' ])
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name' => 'name',
                'data' => 'name',
                'title' => 'Name',
            ],
            [
                'name' => 'value',
                'data' => 'currencies.value',
                'title' => 'Value',
                'orderable' => false,
            ],
            [
                'name' => 'pic',
                'data' => 'pic',
                'title' => 'Pic',
                'orderable' => false,
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'table_currencies_datatable_' . time();
    }
}
