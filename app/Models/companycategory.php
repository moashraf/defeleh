<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class companycategory
 * @package App\Models
 * @version February 12, 2018, 2:05 pm UTC
 *
 * @property string name
 * @property integer parentid
 */
class companycategory extends Model
{
    use SoftDeletes;

    public $table = 'companycategory';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'parentid',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'parentid' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    

        public function get_company ()
{
        // return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
         return $this->hasMany('App\Models\company','categoryid','id');
}



public function parent_category() {
        return $this->belongsTo(self::class, 'parentid', 'id');
    }

    public function children() {
        return $this->hasMany(companycategory::class, 'parentid');
    }
    
}
