<?php namespace Chbakouras\CrudApiGenerator\Service;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @author Chrisostomos Bakouras
 */
interface CrudService
{
    /**
     * Find all models
     *
     * @return Collection
     */
    function findAll();

    /**
     * Find all models sorted by $sort with $dir
     *
     * @param string $sort
     * @param string $dir
     * @return Collection
     */
    function findAllSorted($sort = 'id', $dir = 'asc');

    /**
     * Find all models paginated
     *
     * @param int $perPage
     * @return Collection
     */
    function findAllPaginated($perPage = 20);

    /**
     * Find all models paginated and sorted by $sort with $dir
     *
     * @param int $perPage
     * @param string $sort
     * @param string $dir
     * @return Collection
     */
    function findAllPaginatedSorted($perPage = 20, $sort = 'id', $dir = 'asc');

    /**
     * Find all models with attributes
     *
     * @param array $attributes
     * @return Collection
     */
    function findAllBy(array $attributes);

    /**
     * Find all models with attributes and sorted by $sort with $dir
     *
     * @param array $attributes
     * @param string $sort
     * @param string $dir
     * @return Collection
     */
    function findAllBySorted(array $attributes, $sort = 'id', $dir = 'asc');

    /**
     * Find all models with attributes and paginated
     *
     * @param array $attributes
     * @param int $perPage
     * @return Collection
     */
    function findAllByPaginated(array $attributes, $perPage = 20);

    /**
     * Find all models with attributes, paginated and sorted by $sort with $dir
     *
     * @param array $attributes
     * @param int $perPage
     * @param string $sort
     * @param string $dir
     * @return Collection
     */
    function findAllByPaginatedSorted(array $attributes, $perPage = 20, $sort = 'id', $dir = 'asc');

    /**
     * Find all models that exists in $ids
     *
     * @param array $ids
     * @return Collection
     */
    function findAllWithIds(array $ids = []);

    /**
     * Find model with $id
     *
     * @param $id
     * @return $model
     */
    function findOne($id);

    /**
     * Delete $model
     *
     * @param $model
     * @return bool
     */
    function delete($model);

    /**
     * Delete model with $id
     *
     * @param $id
     * @return bool
     */
    function deleteById($id);

    /**
     * Batch deletes all models within $ids
     *
     * @param array $ids
     * @return void
     */
    function deleteInBatch(array $ids);

    /**
     * Updates all $models with $id
     *
     * @param $model
     * @param $id
     * @return Collection
     */
    function update($model, $id);

    /**
     * Create $model
     *
     * @param $model
     * @return Model
     */
    function create($model);

    /**
     * Check if model with $id exists
     *
     * @param $id
     * @return bool
     */
    function exists($id);

    /**
     * Returns the count of repository models
     *
     * @return int
     */
    function count();
}
