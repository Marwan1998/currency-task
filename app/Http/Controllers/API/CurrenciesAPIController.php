<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCurrenciesAPIRequest;
use App\Http\Requests\API\UpdateCurrenciesAPIRequest;
use App\Models\Currencies;
use App\Repositories\CurrenciesRepository;
use App\Repositories\currencies_infoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CurrenciesController
 * @package App\Http\Controllers\API
 */

class CurrenciesAPIController extends AppBaseController
{
    /** @var  CurrenciesRepository */
    private $currenciesRepository;
    private $currenciesInfoRepository;

    public function __construct(CurrenciesRepository $currenciesRepo, currencies_infoRepository $currenciesInfoRepository)
    {
        $this->currenciesRepository = $currenciesRepo;
        $this->currenciesInfoRepository = $currenciesInfoRepository;
    }

    /**
     * Display a listing of the Currencies.
     * GET|HEAD /currencies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // $currenciesFilter = Currencies::filter()->paginate();
        $currenciesFilter = Currencies::with('currencies')->filter($request)->paginate();

        return response($currenciesFilter, 200);



        // $currencies = $this->currenciesRepository->getLatest();
        // return $this->sendResponse($currencies->toArray(), 'Currencies retrieved successfully');
    }

    /**
     * Store a newly created Currencies in storage.
     * POST /currencies
     *
     * @param CreateCurrenciesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCurrenciesAPIRequest $request)
    {
        $input = $request->all();
        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $imageName = $image->getClientOriginalName();
            $request->file('pic')->storeAs('public/flags/', $imageName);
            $input['pic'] = $imageName;
        } else {
            $input['pic'] = 'none.png';
        }

        // return ['data' => $input];

        try {
            $currencies = $this->currenciesRepository->create($input); // save new currency to currency table
            $input['currency_id'] = $currencies->id;
            $this->currenciesInfoRepository->create($input);
        } catch (\Throwable $th) {
            return $this->sendError('could not create a new Currency'.$th->getMessage());
        }

        return $this->sendResponse($currencies->toArray(), 'A new currency saved successfully');
    }

    /**
     * Display the specified Currencies.
     * GET|HEAD /currencies/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Currencies $currencies */
        $currencies = $this->currenciesRepository->find($id);

        if (empty($currencies)) {
            return $this->sendError('Currencies not found');
        }

        $currencyInfo = $this->currenciesInfoRepository->findValue($id);

        $currencies['value'] = $currencyInfo? $currencyInfo->value : 'none';

        return $this->sendResponse($currencies->toArray(), 'Currencies retrieved successfully');
    }

    /**
     * Update the specified Currencies in storage.
     * PUT/PATCH /currencies/{id}
     * required [name, value] optional [pic]
     *
     * @param int $id
     * @param UpdateCurrenciesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCurrenciesAPIRequest $request)
    {
        $input = $request->all();

        $currencies = $this->currenciesRepository->find($id);

        if (empty($currencies)) {
            return $this->sendError('Currencies not found');
        }

        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $imageName = $image->getClientOriginalName();
            $request->file('pic')->storeAs('public/flags/', $imageName);
            $input['pic'] = $imageName;
        }

        $currencies = $this->currenciesRepository->update($input, $id);

        $input['currency_id'] = $id;

        $currencyInfo = $this->currenciesInfoRepository->create($input);
        $currencies['value'] = $currencyInfo? $currencyInfo->value : 'none';

        return $this->sendResponse($currencies->toArray(), 'Currencies updated successfully');
    }

    /**
     * Remove the specified Currencies from storage.
     * DELETE /currencies/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $currencies = $this->currenciesRepository->find($id);

        if (empty($currencies)) {
            return $this->sendError('Currencies not found');
        }

        $currencies->delete();

        return $this->sendSuccess('A currency deleted successfully');
    }
}
