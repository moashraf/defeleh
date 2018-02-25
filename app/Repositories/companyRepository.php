<?php

namespace App\Repositories;

use App\Models\company;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class companyRepository
 * @package App\Repositories
 * @version February 12, 2018, 2:18 pm UTC
 *
 * @method company findWithoutFail($id, $columns = ['*'])
 * @method company find($id, $columns = ['*'])
 * @method company first($columns = ['*'])
*/
class companyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ownerid',
        'name',
        'image',
        'categoryid',
        'address',
        'phones',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return company::class;
    }
}
