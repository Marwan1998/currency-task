<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TableCurrencies
 * @package App\Models
 * @version January 7, 2023, 10:36 am UTC
 *
 * @property string $name
 * @property string $pic
 */
class TableCurrencies extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'currencies';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'pic'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'pic' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:7',
        'pic' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function getValues()
    {
        // return $this->hasMany(currencies_info::class, 'currency_id', 'id');
        return $this->hasOne(currencies_info::class, 'currency_id', 'id')->latest('created_at');
    }

    public function currencies()
    {
        return $this->hasOne(currencies_info::class, 'currency_id', 'id')->latest('created_at');
        //will get the last inserted value.
    }

    
}
