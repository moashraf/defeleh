<?php

namespace App\Repositories;

use App\Models\job;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class jobRepository
 * @package App\Repositories
 * @version February 12, 2018, 2:36 pm UTC
 *
 * @method job findWithoutFail($id, $columns = ['*'])
 * @method job find($id, $columns = ['*'])
 * @method job first($columns = ['*'])
*/
class jobRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'content',
        'contact',
        'companyid'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return job::class;
    }
}
