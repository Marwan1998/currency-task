<?php

namespace App\Repositories;

use App\Models\Currencies;
use App\Repositories\BaseRepository;

/**
 * Class CurrenciesRepository
 * @package App\Repositories
 * @version January 4, 2023, 9:05 am UTC
*/

class CurrenciesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'pic'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Currencies::class;
    }

    // get all with last value.
    public function getLatest()
    {
        return Currencies::with('currencies')->get();
    }
}
