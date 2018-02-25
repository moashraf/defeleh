<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class job
 * @package App\Models
 * @version February 12, 2018, 2:36 pm UTC
 *
 * @property string title
 * @property string content
 * @property string contact
 * @property integer companyid
 */
class job extends Model
{
    use SoftDeletes;

    public $table = 'jobs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'content',
        'contact',
        'companyid'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'content' => 'string',
        'contact' => 'string',
        'companyid' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

  
     public function get_job_company ()
{
         return $this->hasOne('App\Models\company','id','companyid');
}  

}
