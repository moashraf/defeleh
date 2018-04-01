<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class userFollow  extends Model
{
    use SoftDeletes;

    public $table = 'user_follow';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'followed_user_id'
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
