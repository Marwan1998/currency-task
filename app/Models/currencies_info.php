<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class currencies_info
 * @package App\Models
 * @version January 2, 2023, 12:03 pm UTC
 *
 * @property \App\Models\Currencies $currencies
 * @property integer $currency_id
 * @property number $value
 */
class currencies_info extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'currencies_infos';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'currency_id',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'currency_id' => 'integer',
        'value' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'value' => 'required',
        // 'currency_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function currencies()
    {
        return $this->belongsTo(\App\Models\Currencies::class, 'currency_id', 'id');
    }
    
}
