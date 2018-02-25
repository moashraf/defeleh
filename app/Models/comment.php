<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class comment
 * @package App\Models
 * @version February 12, 2018, 2:28 pm UTC
 *
 * @property string content
 * @property integer ownerid
 * @property integer postid
 */
class comment extends Model
{
    use SoftDeletes;

    public $table = 'comment';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'content',
        'ownerid',
        'postid'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'content' => 'string',
        'ownerid' => 'integer',
        'postid' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
