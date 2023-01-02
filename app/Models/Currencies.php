<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Currencies
 * @package App\Models
 * @version January 2, 2023, 12:25 pm UTC
 *
 * @property string $name
 * @property string $pic
 */
class Currencies extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'currencies';
    

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
        'name' => 'string',
        'pic' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
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
