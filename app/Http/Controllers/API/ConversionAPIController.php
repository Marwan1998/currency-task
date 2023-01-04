<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\CurrenciesRepository;


class ConversionAPIController extends Controller
{
    /** @var  currenciesRepository */
    private $currenciesRepository;

    public function __construct(CurrenciesRepository $currenciesRepo)
    {
        $this->currenciesRepository = $currenciesRepo;
    }

    public function index()
    {
        return response('Hiii from index', 200);
    }

    //return the value in specific currency.
    public function convertCurruncy($value, $name)
    {
        $currency = $this->currenciesRepository->findByName($name);

        if (!count($currency)) {
            return response('No currency data avilible', 404);
        }
        $currency = $currency[0];

        $result = $currency['currencies']->value * $value;
        
        return response([
            'result' => $result,
            'currency' => 'LYD/'.strtoupper($name)
        ], 200);
    }

    //return the value of all currencies.
    public function convert($value)
    {
        $currencies = $this->currenciesRepository->getLatest();

        if (!count($currencies)) {
            return response([
                'success' => false,
                'message' => 'no avalible data',
            ], 200);
        }

        $result = [];
        foreach ($currencies as $currency) {
            array_push($result, [
                $currency->name => number_format($value * $currency->currencies->value, 3)
            ]);
        }

        return response([
            'success' => true,
            'message' => $value.' LYD = ',
            'result' => $result
        ], 200);

    }

}
