<?php

namespace App\Repositories;

use App\Models\companycategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class companycategoryRepository
 * @package App\Repositories
 * @version February 12, 2018, 2:05 pm UTC
 *
 * @method companycategory findWithoutFail($id, $columns = ['*'])
 * @method companycategory find($id, $columns = ['*'])
 * @method companycategory first($columns = ['*'])
*/
class companycategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'parentid'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return companycategory::class;
    }
}
