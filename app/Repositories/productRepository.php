<?php

namespace App\Repositories;

use App\Models\product;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class productRepository
 * @package App\Repositories
 * @version February 12, 2018, 3:13 pm UTC
 *
 * @method product findWithoutFail($id, $columns = ['*'])
 * @method product find($id, $columns = ['*'])
 * @method product first($columns = ['*'])
*/
class productRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'image',
        'description',
        'companyid',
        'price',
        'fabric',
        'least',
        'colors',
        'images'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return product::class;
    }
}
