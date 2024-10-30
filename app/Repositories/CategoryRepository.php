<?php

namespace App\Repositories;

use App\Models\Category;

/**
 * Class CategoryRepository
 *
 * @version August 25, 2020, 10:52 am UTC
 */
class CategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Category::class;
    }
}
