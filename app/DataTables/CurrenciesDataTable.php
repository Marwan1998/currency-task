<?php

namespace App\DataTables;

use App\Models\Currencies;
use App\Repositories\CurrenciesRepository;
use App\Models\currencies_info;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Debugbar;

class CurrenciesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

     private $currenciesRepository;
 
     public function __construct(CurrenciesRepository $currenciesRepo)
     {
         $this->currenciesRepository = $currenciesRepo;
     }


    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        Debugbar::info($query);

        $dataTable = $dataTable->addColumn('action', 'currencies.datatables_actions');

        $dataTable->addColumn('value', '0.00');
        // $dataTable->editColumn('pic', 'currencies.values_data');


        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Test $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Currencies $model)
    {
        return $model->newQuery();
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
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
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
            'name',
            'value',
            'pic'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'currencies_datatable_' . time();
    }
}
