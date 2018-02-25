<?php

namespace App\Repositories;

use App\Models\post;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class postRepository
 * @package App\Repositories
 * @version February 12, 2018, 2:27 pm UTC
 *
 * @method post findWithoutFail($id, $columns = ['*'])
 * @method post find($id, $columns = ['*'])
 * @method post first($columns = ['*'])
*/
class postRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'content',
        'image',
        'ownerid',
        'ownertype'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return post::class;
    }
}
