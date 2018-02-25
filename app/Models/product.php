<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class product
 * @package App\Models
 * @version February 12, 2018, 3:13 pm UTC
 *
 * @property string name
 * @property string image
 * @property string description
 * @property integer companyid
 * @property integer price
 * @property string fabric
 * @property string least
 * @property string colors
 * @property string images
 */
class product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'image',
        'description',
        'companyid',
        'price',
        'fabric',
        'least',
        'colors',
        'images'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'image' => 'string',
        'description' => 'string',
        'companyid' => 'integer',
        'price' => 'integer',
        'fabric' => 'string',
        'least' => 'string',
        'colors' => 'string',
        'images' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
