<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\CreateCurrenciesAPIRequest;
use App\Http\Requests\API\UpdateCurrenciesAPIRequest;
use App\Models\Currencies;
use App\Repositories\CurrenciesRepository;
use App\Repositories\currencies_infoRepository;
use App\Http\Controllers\AppBaseController;
use Response;


class TestController extends Controller
{

    private $currenciesRepository;
    private $currenciesInfoRepository;
    private $appBaseController;

    public function __construct(CurrenciesRepository $currenciesRepo, currencies_infoRepository $currenciesInfoRepository)
    {
        $this->currenciesRepository = $currenciesRepo;
        $this->currenciesInfoRepository = $currenciesInfoRepository;
        $this->appBaseController = new AppBaseController();
    }

    /**
     * GET|HEAD /currencies
     * @return Response
     */
    public function index(Request $request)
    {
        // return response('Currencies index', 200);
        $currencies = $this->currenciesRepository->getLatest();
        
        return $this->appBaseController->sendResponse($currencies->toArray(), 'Currencies retrieved successfully');
    }

    /**
     * POST /currencies
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        return ['data' => $input];

        $currencies = $this->currenciesRepository->create($input);

        return $this->appBaseController->sendResponse($currencies->toArray(), 'Currencies saved successfully');
    }

    /**
     * GET|HEAD /currencies/{id}
     * @return Response
     */
    public function show($id)
    {
        /** @var Currencies $currencies */
        $currencies = $this->currenciesRepository->find($id);

        if (empty($currencies)) {
            return $this->appBaseController->sendError('Currencies not found');
        }

        $currencyInfo = $this->currenciesInfoRepository->findValue($id);

        $currencies['value'] = $currencyInfo? $currencyInfo->value : 'none';

        return $this->appBaseController->sendResponse($currencies->toArray(), 'Currencies retrieved successfully');
    }

    /**
     * PUT/PATCH /currencies/{id}
     * @return Response
     */
    public function update($id, $request)
    {
        return response('Currencies updated successfully', 200);
    }

    /**
     * DELETE /currencies/{id}
     * @param int $id
     */
    public function destroy($id)
    {
        return response('Currencies deleted successfully', 200);
    }
}

