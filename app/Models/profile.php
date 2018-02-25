<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class profile
 * @package App\Models
 * @version February 12, 2018, 1:19 pm UTC
 *
 * @property integer userid
 * @property string fullname
 * @property string cellphone
 * @property string profileimage
 * @property string address
 */
class profile extends Model
{
    use SoftDeletes;

    public $table = 'profile';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'userid',
        'fullname',
        'cellphone',
        'profileimage',
        'address',
        'user_role',
        'api_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'userid' => 'integer',
        'user_role'=> 'integer',
        'fullname' => 'string',
        'cellphone' => 'string',
        'profileimage' => 'string',
        'address' => 'string',
        'api_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
