<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createcurrencies_infoRequest;
use App\Http\Requests\Updatecurrencies_infoRequest;
use App\Repositories\currencies_infoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Response;

class currencies_infoController extends AppBaseController
{
    /** @var currencies_infoRepository $currenciesInfoRepository*/
    private $currenciesInfoRepository;

    public function __construct(currencies_infoRepository $currenciesInfoRepo)
    {
        $this->currenciesInfoRepository = $currenciesInfoRepo;
    }

    /**
     * Display a listing of the currencies_info.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $currenciesInfos = $this->currenciesInfoRepository->all();

        return view('currencies_infos.index')
            ->with('currenciesInfos', $currenciesInfos);
    }

    /**
     * Show the form for creating a new currencies_info.
     *
     * @return Response
     */
    public function create()
    {
        return view('currencies_infos.create');
    }

    /**
     * Store a newly created currencies_info in storage.
     *
     * @param Createcurrencies_infoRequest $request
     *
     * @return Response
     */
    public function store(Createcurrencies_infoRequest $request)
    {
        $input = $request->all();

        $currenciesInfo = $this->currenciesInfoRepository->create($input);

        Flash::success('Currencies Info saved successfully.');

        return redirect(route('currenciesInfos.index'));
    }

    /**
     * Display the specified currencies_info.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $currenciesInfo = $this->currenciesInfoRepository->find($id);

        if (empty($currenciesInfo)) {
            Flash::error('Currencies Info not found');

            return redirect(route('currenciesInfos.index'));
        }

        return view('currencies_infos.show')->with('currenciesInfo', $currenciesInfo);
    }

    /**
     * Show the form for editing the specified currencies_info.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $currenciesInfo = $this->currenciesInfoRepository->find($id);

        if (empty($currenciesInfo)) {
            Flash::error('Currencies Info not found');

            return redirect(route('currenciesInfos.index'));
        }

        return view('currencies_infos.edit')->with('currenciesInfo', $currenciesInfo);
    }

    /**
     * Update the specified currencies_info in storage.
     *
     * @param int $id
     * @param Updatecurrencies_infoRequest $request
     *
     * @return Response
     */
    public function update($id, Updatecurrencies_infoRequest $request)
    {
        $currenciesInfo = $this->currenciesInfoRepository->find($id);

        if (empty($currenciesInfo)) {
            Flash::error('Currencies Info not found');

            return redirect(route('currenciesInfos.index'));
        }

        $currenciesInfo = $this->currenciesInfoRepository->update($request->all(), $id);

        Flash::success('Currencies Info updated successfully.');

        return redirect(route('currenciesInfos.index'));
    }

    /**
     * Remove the specified currencies_info from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $currenciesInfo = $this->currenciesInfoRepository->find($id);

        if (empty($currenciesInfo)) {
            Flash::error('Currencies Info not found');

            return redirect(route('currenciesInfos.index'));
        }

        $this->currenciesInfoRepository->delete($id);

        Flash::success('Currencies Info deleted successfully.');

        return redirect(route('currenciesInfos.index'));
    }
}
