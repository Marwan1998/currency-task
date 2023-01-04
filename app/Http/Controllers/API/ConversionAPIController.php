<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\currencies_infoRepository;
use App\Repositories\CurrenciesRepository;


class ConversionAPIController extends Controller
{
    /** @var  currenciesRepository */
    /** @var  currenciesInfoRepository */
    private $currenciesRepository;
    private $currenciesInfoRepository;

    public function __construct(CurrenciesRepository $currenciesRepo, currencies_infoRepository $currenciesInfoRepository)
    {
        $this->currenciesRepository = $currenciesRepo;
        $this->currenciesInfoRepository = $currenciesInfoRepository;
    }

    public function index()
    {
        return response('Hiii from index', 200);
    }

    public function convert($value, $name)
    {

        $currency = $this->currenciesRepository->findByName($name);

        if (!count($currency)) {
            return response('No currency data avilible', 404);
        }
        $currency = $currency[0];

        $result = $currency['currencies']->value * $value;
        $result = [
            'result' => $result,
            'currency' => 'LYD/'.strtoupper($name)
        ];
        
        return response($result, 200);
    }


}
