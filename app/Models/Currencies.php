<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LaravelLegends\EloquentFilter\Concerns\HasFilter;


/**
 * Class Currencies
 * @package App\Models
 * @version January 4, 2023, 9:05 am UTC
 *
 * @property string $name
 * @property string $pic
 */
class Currencies extends Model
{
    use SoftDeletes, HasFilter;

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
        'name' => 'string',
        'pic' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:3|max:3',
        'value' => 'required'
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

    //mutator method, to save all currencies names as upper case.
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtoupper($name);
    }

    //accssor method, to retrive all currencies names as upper case.
    public function getNameAttribute($name)
    {
        return strtoupper($name);
    }
    
}

/*
* infyom API generated code.

public static $rules = [
    'name' => 'required|string|max:7',
    'pic' => 'required|string|max:255',
    'created_at' => 'nullable',
    'updated_at' => 'nullable',
    'deleted_at' => 'nullable'
];

protected $casts = [
    'id' => 'integer',
    'name' => 'string',
    'pic' => 'string'
];

*/
