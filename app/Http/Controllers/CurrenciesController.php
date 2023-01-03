<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCurrenciesRequest;
use App\Http\Requests\UpdateCurrenciesRequest;
use App\Repositories\CurrenciesRepository;
use App\Repositories\currencies_infoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use App\Models\Currencies;
use Response;

class CurrenciesController extends AppBaseController
{
    /** @var CurrenciesRepository $currenciesRepository*/
    private $currenciesRepository;
    private $currenciesInfoRepository;

    public function __construct(CurrenciesRepository $currenciesRepo, currencies_infoRepository $currenciesInfoRepository)
    {
        $this->currenciesRepository = $currenciesRepo;
        $this->currenciesInfoRepository = $currenciesInfoRepository;
    }

    /**
     * Display a listing of the Currencies.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // $currencies = $this->currenciesRepository->all(); //to-Remove
        $currencies = $this->currenciesRepository->getLatest();

        // Debug
        // return [
        //     'WithValues' => $currencies,
        //     // 'WithValues' => Currencies::find(1)->getValues()->where('id', '=', '2')->first(),
        //     // 'WithValues' => Currencies::find(1)->getValues()->orderBy('created_at', 'desc')->first(),
        // ];

        return view('currencies.index')->with('currencies', $currencies);
    }

    /**
     * Show the form for creating a new Currencies.
     *
     * @return Response
     */
    public function create()
    {
        return view('currencies.create');
    }

    /**
     * Store a newly created Currencies in storage.
     *
     * @param CreateCurrenciesRequest $request
     *
     * @return Response
     */
    public function store(CreateCurrenciesRequest $request)
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
        // $url = Storage::url($imageName); // if i want to save the url

        $currencies = $this->currenciesRepository->create($input); // save new currency to currency table
        
        $input['currency_id'] = $currencies->id;

        $this->currenciesInfoRepository->create($input);

        Flash::success('Currencies saved successfully.');

        return redirect(route('currencies.index'));
    }

    /**
     * Display the specified Currencies.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $currencies = $this->currenciesRepository->find($id);

        if (empty($currencies)) {
            Flash::error('Currencies not found');

            return redirect(route('currencies.index'));
        }
        
        $value = $this->currenciesInfoRepository->findValue($id);

        $currencies['value'] = $value? $value->value : 'none';

        return view('currencies.show')->with('currencies', $currencies);
    }

    /**
     * Show the form for editing the specified Currencies.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $currencies = $this->currenciesRepository->find($id);

        if (empty($currencies)) {
            Flash::error('Currencies not found');

            return redirect(route('currencies.index'));
        }

        // $value = $this->currenciesInfoRepository->find($id, ['value', 'currency_id']);
        $value = $this->currenciesInfoRepository->findValue($id);

        return view('currencies.edit')
        ->with('currencies', $currencies)
        ->with('values', $value); //TODO:: check this useless send.
    }

    /**
     * Update the specified Currencies in storage.
     *
     * @param int $id
     * @param UpdateCurrenciesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCurrenciesRequest $request)
    {
        $currencies = $this->currenciesRepository->find($id);

        if (empty($currencies)) {
            Flash::error('Currencies not found');

            return redirect(route('currencies.index'));
        }

        $input = $request->all();
        // $currencies =
        $this->currenciesRepository->update($input, $id);
        $input['currency_id'] = $id;
        $this->currenciesInfoRepository->create($input);

        Flash::success('Currencies updated successfully.');

        return redirect(route('currencies.index'));
    }

    /**
     * Remove the specified Currencies from storage.
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
            Flash::error('Currencies not found');

            return redirect(route('currencies.index'));
        }

        $this->currenciesRepository->delete($id);

        Flash::success('Currencies deleted successfully.');

        return redirect(route('currencies.index'));
    }
}
