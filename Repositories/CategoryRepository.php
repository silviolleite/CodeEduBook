<?php

namespace CodeEduBook\Repositories;

use App\Criteria\CriteriaTrashedInterface;
use App\Repositories\RepositoryRestoreInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository.
 *
 * @package namespace App\Repositories;
 */
interface CategoryRepository extends RepositoryInterface, CriteriaTrashedInterface, RepositoryRestoreInterface
{
    public function listsWithMutators($column, $key = null);
}
