<?php

namespace App\Repositories;

use App\Models\TableCurrencies;
use App\Repositories\BaseRepository;

/**
 * Class TableCurrenciesRepository
 * @package App\Repositories
 * @version January 7, 2023, 10:36 am UTC
*/

class TableCurrenciesRepository extends BaseRepository
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
        return TableCurrencies::class;
    }
}
