<?php namespace Chbakouras\CrudApiGenerator\Service;

use Chbakouras\CrudApiGenerator\Repository\EloquentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @author Chrisostomos Bakouras
 */
abstract class BaseEloquentCrudService implements CrudService
{
    /** @var EloquentRepository */
    protected $repository;

    /**
     * Find all models
     *
     * @return Collection
     */
    function findAll()
    {
        return $this->repository
            ->findAll();
    }

    /**
     * Find all models sorted by $sort with $dir
     *
     * @param string $sort
     * @param string $dir
     * @return Collection
     */
    function findAllSorted($sort = 'id', $dir = 'asc')
    {
        return $this->repository
            ->findAllSorted($sort, $dir);
    }

    /**
     * Find all models paginated
     *
     * @param int $perPage
     * @return Collection
     */
    function findAllPaginated($perPage = 20)
    {
        return $this->repository
            ->findAllPaginated($perPage);
    }

    /**
     * Find all models paginated and sorted by $sort with $dir
     *
     * @param int $perPage
     * @param string $sort
     * @param string $dir
     * @return Collection
     */
    function findAllPaginatedSorted($perPage = 20, $sort = 'id', $dir = 'asc')
    {
        return $this->repository
            ->findAllPaginatedSorted($perPage, $sort, $dir);
    }

    /**
     * Find all models with attributes
     *
     * @param array $attributes
     * @return Collection
     */
    function findAllBy(array $attributes)
    {
        return $this->repository
            ->findAllBy($attributes);
    }

    /**
     * Find all models with attributes and sorted by $sort with $dir
     *
     * @param array $attributes
     * @param string $sort
     * @param string $dir
     * @return Collection
     */
    function findAllBySorted(array $attributes, $sort = 'id', $dir = 'asc')
    {
        return $this->repository
            ->findAllBySorted($attributes, $sort, $dir);
    }

    /**
     * Find all models with attributes and paginated
     *
     * @param array $attributes
     * @param int $perPage
     * @return Collection
     */
    function findAllByPaginated(array $attributes, $perPage = 20)
    {
        return $this->repository
            ->findAllByPaginated($attributes, $perPage);
    }

    /**
     * Find all models with attributes, paginated and sorted by $sort with $dir
     *
     * @param array $attributes
     * @param int $perPage
     * @param string $sort
     * @param string $dir
     * @return Collection
     */
    function findAllByPaginatedSorted(array $attributes, $perPage = 20, $sort = 'id', $dir = 'asc')
    {
        return $this->repository
            ->findAllByPaginatedSorted($attributes, $perPage, $sort, $dir);
    }

    /**
     * Find all models that exists in $ids
     *
     * @param array $ids
     * @return Collection
     */
    function findAllWithIds(array $ids = [])
    {
        return $this->repository
            ->findAllWithIds($ids);
    }

    /**
     * Find model with $id
     *
     * @param $id
     * @return $model
     */
    function findOne($id)
    {
        return $this->repository
            ->findOne($id);
    }

    /**
     * Delete $model
     *
     * @param $model
     * @return bool
     */
    function delete($model)
    {
        return $this->repository
            ->delete($model);
    }

    /**
     * Delete model with $id
     *
     * @param $id
     * @return bool
     */
    function deleteById($id)
    {
        return $this->repository
            ->deleteById($id);
    }

    /**
     * Batch deletes all models within $ids
     *
     * @param array $ids
     * @return void
     */
    function deleteInBatch(array $ids)
    {
        $this->repository
            ->deleteInBatch($ids);
    }

    /**
     * Updates all $models with $id
     *
     * @param array $attributes
     * @param $id
     * @return Collection
     */
    function update($attributes, $id)
    {
        return $this->repository
            ->update($attributes, $id);
    }

    /**
     * Create $model
     *
     * @param array $attributes
     * @return Model
     */
    function create($attributes)
    {
        return $this->repository
            ->create($attributes);
    }

    /**
     * Check if model with $id exists
     *
     * @param $id
     * @return bool
     */
    function exists($id)
    {
        return $this->repository
            ->exists($id);
    }

    /**
     * Returns the count of repository models
     *
     * @return int
     */
    function count()
    {
        return $this->repository
            ->count();
    }
}
