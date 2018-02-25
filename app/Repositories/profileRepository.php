<?php

namespace App\Repositories;

use App\Models\profile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class profileRepository
 * @package App\Repositories
 * @version February 12, 2018, 1:19 pm UTC
 *
 * @method profile findWithoutFail($id, $columns = ['*'])
 * @method profile find($id, $columns = ['*'])
 * @method profile first($columns = ['*'])
*/
class profileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'userid',
        'fullname',
        'cellphone',
        'profileimage',
        'address'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return profile::class;
    }
}
