<?php

namespace App\Repositories;

use App\Models\Currencies;
use App\Repositories\BaseRepository;

/**
 * Class CurrenciesRepository
 * @package App\Repositories
 * @version January 2, 2023, 12:25 pm UTC
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

    // get all with last value.
    public function getLatest()
    {
        return Currencies::with('currencies')->get();
    }

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
}
