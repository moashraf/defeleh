<?php

namespace App\Models;

 
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class company
 * @package App\Models
 * @version February 12, 2018, 2:18 pm UTC
 *
 * @property integer ownerid
 * @property string name
 * @property string image
 * @property integer categoryid
 * @property string address
 * @property string phones
 * @property string description
 */
class company extends Model
{
    use SoftDeletes;

    public $table = 'company';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'ownerid',
        'name',
        'image',
        'categoryid',
        'address',
        'phones',
        'company_code',
        'website_company',
        'facebook_page',
        'area',
        'city',
         'description'
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ownerid' => 'integer',
        'name' => 'string',
        'image' => 'string',
        'categoryid' => 'integer',
        'address' => 'string',
        'phones' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    // relations

 public function get_like ()
    {
return $this->hasMany('App\Models\like', 'company_id', 'id');
    }

    public function get_company_user ()
    {
        return $this->hasOne('App\User','id','ownerid');
    }
    public function get_company_cat ()
    {
        return $this->hasOne('App\Models\companycategory','id','categoryid');
    }
    public function get_company_jobs ()
    {
        return $this->hasMany('App\Models\job', 'companyid', 'id');
    }
    public function get_company_products ()
    {
        return $this->hasMany('App\Models\product', 'companyid', 'id');
    }
    public function get_company_post ()
    {
        return $this->hasMany('App\Models\post', 'companyid', 'id');
    }
      public function get_followers ()
    {
        return $this->hasMany('App\Models\CompanyFollow', 'company_id', 'id');
    }

}
