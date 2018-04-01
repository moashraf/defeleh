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
class Msg extends Model
{
    use SoftDeletes;

    public $table = 'Msg';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'sender_id',
        'reciever_id',
        'room_id',
        'message'
    ];

  
    public static $rules = [
        
    ];

    public function get_user ()
    {
        return $this->hasMany('App\User', 'id', 'sender_id');
    }
    
      public function get_profile ()
    {
        return $this->hasMany('App\Models\profile', 'userid', 'sender_id');
    }
    
    

}
