<?php

namespace App\Repositories;

use App\Models\like;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class likeRepository
 * @package App\Repositories
 * @version February 12, 2018, 2:30 pm UTC
 *
 * @method like findWithoutFail($id, $columns = ['*'])
 * @method like find($id, $columns = ['*'])
 * @method like first($columns = ['*'])
*/
class likeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'userid',
        'postid'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return like::class;
    }
}
