<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class post
 * @package App\Models
 * @version February 12, 2018, 2:27 pm UTC
 *
 * @property string title
 * @property string content
 * @property string image
 * @property integer ownerid
 * @property string ownertype
 */
class post extends Model
{
    use SoftDeletes;

    public $table = 'post';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'content',
        'image',
        'ownerid',
        'companyid',
        'ownertype'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'content' => 'string',
        'image' => 'string',
        'companyid' => 'integer',
        'ownerid' => 'integer',
        'ownertype' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
