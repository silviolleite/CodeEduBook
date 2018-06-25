<?php

namespace CodeEduBook\Repositories;

use App\Criteria\CriteriaTrashedTrait;
use App\Repositories\RepositoryRestoreTrait;
use CodeEduBook\Repositories\CategoryRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduBook\Models\Category;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    use CriteriaTrashedTrait;
    use RepositoryRestoreTrait;

    protected $fieldSearchable = [
      'name' => 'like'
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function listsWithMutators($column, $key = null)
    {
        $collection = $this->all();
        return $collection->pluck($column, $key);
    }
}
