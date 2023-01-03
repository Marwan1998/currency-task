<?php

namespace App\Repositories;

use App\Models\currencies_info;
use App\Repositories\BaseRepository;

/**
 * Class currencies_infoRepository
 * @package App\Repositories
 * @version January 2, 2023, 12:03 pm UTC
*/

class currencies_infoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'currency_id',
        'value'
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
        return currencies_info::class;
    }

    public function findValue($currencyID)
    {
        return currencies_info::where('currency_id', $currencyID)
        ->orderBy('updated_at', 'desc')
        ->first(['value', 'currency_id', 'updated_at']);
    }
}
