<?php namespace Chbakouras\CrudApiGenerator\Repository;

/**
 * @author Chrisostomos Bakouras
 */
abstract class BaseEloquentRepository implements EloquentRepository
{
    protected $model;
    protected $query;

    public function __construct()
    {
        $this->model = resolve($this->model());
    }

    abstract function model();

    function create(array $attributes)
    {
        return $this->model
            ->newQuery()
            ->create($attributes);
    }

    function update(array $attributes, $id, $attribute = 'id')
    {
        $this->model
            ->newQuery()
            ->where($attribute, '=', $id)
            ->update($attributes);

        return $this->findOne($id);
    }

    function findAll()
    {
        return $this->model
            ->newQuery()
            ->get();
    }

    function findAllSorted($sort = 'id', $dir = 'asc')
    {
        return $this->model
            ->newQuery()
            ->orderBy($sort, $dir)
            ->get();
    }

    function findAllPaginated($perPage = 20)
    {
        return $this->model
            ->newQuery()
            ->paginate($perPage);
    }

    function findAllPaginatedSorted($perPage = 20, $sort = 'id', $dir = 'asc')
    {
        return $this->model
            ->newQuery()
            ->orderBy($sort, $dir)
            ->paginate($perPage);
    }

    function findAllBy(array $attributes)
    {
        return $this
            ->applyQueryAttributes($attributes)
            ->get();
    }

    function findAllBySorted(array $attributes, $sort = 'id', $dir = 'asc')
    {
        return $this
            ->applyQueryAttributes($attributes)
            ->orderBy($sort, $dir)
            ->get();
    }

    function findAllByPaginated(array $attributes, $perPage = 20)
    {
        return $this
            ->applyQueryAttributes($attributes)
            ->paginate($perPage);
    }

    function findAllByPaginatedSorted(array $attributes, $perPage = 20, $sort = 'id', $dir = 'asc')
    {
        return $this
            ->applyQueryAttributes($attributes)
            ->orderBy($sort, $dir)
            ->paginate($perPage);
    }

    function findAllWithIds(array $ids = [])
    {
        return $this->model
            ->newQuery()
            ->whereIn($this->model->getKeyName(), $ids)
            ->get();
    }

    function findOne($id)
    {
        return $this->model
            ->newQuery()
            ->find($id);
    }

    function delete($model)
    {
        return $this->model
            ->newQuery()
            ->where($this->model->getKeyName(), $model->getKey())
            ->delete();
    }

    function deleteById($id)
    {
        return $this->model
            ->newQuery()
            ->where($this->model->getKeyName(), $id)
            ->delete();
    }

    function deleteInBatch(array $ids)
    {
        $this->model
            ->newQuery()
            ->whereIn($this->model->getKeyName(), $ids)
            ->delete();
    }

    function save($model)
    {
        return $model->save();
    }

    function saveModels(array $models)
    {
        return collect($models)
            ->map(function ($model) {
                return $model->save();
            });
    }

    function exists($id)
    {
        return $this->model
            ->newQuery()
            ->find($id)
            ? true
            : false;
    }

    function count()
    {
        return $this->model
            ->newQuery()
            ->count();
    }

    function applyQueryAttributes(array $attributes)
    {
        $query = $this->model->newQuery();

        foreach ($attributes as $key => $attribute) {
            if ($attribute != null) {
                $query = $query->where($key, $attribute);
            }
        }

        return $query;
    }
}
