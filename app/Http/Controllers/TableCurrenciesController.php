<?php

namespace App\Http\Controllers;

use App\DataTables\TableCurrenciesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTableCurrenciesRequest;
use App\Http\Requests\UpdateTableCurrenciesRequest;
use App\Repositories\TableCurrenciesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\TableCurrencies;
use App\Repositories\CurrenciesRepository;
use App\Repositories\currencies_infoRepository;

class TableCurrenciesController extends AppBaseController
{
    /** @var TableCurrenciesRepository $tableCurrenciesRepository*/
    private $tableCurrenciesRepository;
    private $currenciesRepository;
    private $currenciesInfoRepository;

    public function __construct(TableCurrenciesRepository $tableCurrenciesRepo, CurrenciesRepository $currenciesRepository, currencies_infoRepository $currenciesInfoRepository)
    {
        $this->tableCurrenciesRepository = $tableCurrenciesRepo;
        $this->currenciesRepository = $currenciesRepository;
        $this->currenciesInfoRepository = $currenciesInfoRepository;
    }

    /**
     * Display a listing of the TableCurrencies.
     *
     * @param TableCurrenciesDataTable $tableCurrenciesDataTable
     *
     * @return Response
     */
    public function index(TableCurrenciesDataTable $tableCurrenciesDataTable)
    {
        return $tableCurrenciesDataTable->render('table_currencies.index');
    }

    /**
     * Show the form for creating a new TableCurrencies.
     *
     * @return Response
     */
    public function create()
    {
        return view('table_currencies.create');
    }

    /**
     * Store a newly created TableCurrencies in storage.
     *
     * @param CreateTableCurrenciesRequest $request
     *
     * @return Response
     */
    public function store(CreateTableCurrenciesRequest $request)
    {
        $input = $request->all();

        $tableCurrencies = $this->tableCurrenciesRepository->create($input);

        Flash::success('Table Currencies saved successfully.');

        return redirect(route('tableCurrencies.index'));
    }

    /**
     * Display the specified TableCurrencies.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tableCurrencies = $this->tableCurrenciesRepository->find($id);

        if (empty($tableCurrencies)) {
            Flash::error('Table Currencies not found');

            return redirect(route('tableCurrencies.index'));
        }

        $currencyInfo = $this->currenciesInfoRepository->findValue($id);

        $tableCurrencies['value'] = $currencyInfo? $currencyInfo->value : 'none';

        return view('table_currencies.show')->with('tableCurrencies', $tableCurrencies);
    }

    /**
     * Show the form for editing the specified TableCurrencies.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tableCurrencies = $this->tableCurrenciesRepository->find($id);

        if (empty($tableCurrencies)) {
            Flash::error('Table Currencies not found');

            return redirect(route('tableCurrencies.index'));
        }

        return view('table_currencies.edit')->with('tableCurrencies', $tableCurrencies);
    }

    /**
     * Update the specified TableCurrencies in storage.
     *
     * @param int $id
     * @param UpdateTableCurrenciesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTableCurrenciesRequest $request)
    {
        $tableCurrencies = $this->tableCurrenciesRepository->find($id);

        if (empty($tableCurrencies)) {
            Flash::error('Table Currencies not found');

            return redirect(route('tableCurrencies.index'));
        }

        $tableCurrencies = $this->tableCurrenciesRepository->update($request->all(), $id);

        Flash::success('Table Currencies updated successfully.');

        return redirect(route('tableCurrencies.index'));
    }

    /**
     * Remove the specified TableCurrencies from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tableCurrencies = $this->tableCurrenciesRepository->find($id);

        if (empty($tableCurrencies)) {
            Flash::error('Table Currencies not found');

            return redirect(route('tableCurrencies.index'));
        }

        $this->tableCurrenciesRepository->delete($id);

        Flash::success('Table Currencies deleted successfully.');

        return redirect(route('tableCurrencies.index'));
    }
}
