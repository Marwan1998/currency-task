<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Role
 * @package App\Models
 * @version January 10, 2023, 8:33 am UTC
 *
 * @property string $name
 * @property string $guard
 */
class Role extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'roles';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'guard'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'guard' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:roles',
        'guard' => 'required'
    ];

    
}
