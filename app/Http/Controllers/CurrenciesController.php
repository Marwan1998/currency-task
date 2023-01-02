<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCurrenciesRequest;
use App\Http\Requests\UpdateCurrenciesRequest;
use App\Repositories\CurrenciesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Response;

class CurrenciesController extends AppBaseController
{
    /** @var CurrenciesRepository $currenciesRepository*/
    private $currenciesRepository;

    public function __construct(CurrenciesRepository $currenciesRepo)
    {
        $this->currenciesRepository = $currenciesRepo;
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
        $currencies = $this->currenciesRepository->all();

        return view('currencies.index')
            ->with('currencies', $currencies);
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
            $request->file('pic')->storeAs('flags', $imageName);
        }
        $input['pic'] = $imageName;

        $currencies = $this->currenciesRepository->create($input);

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

        return view('currencies.edit')->with('currencies', $currencies);
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

        $currencies = $this->currenciesRepository->update($request->all(), $id);

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
