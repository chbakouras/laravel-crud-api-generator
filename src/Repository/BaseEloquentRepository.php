<?php namespace Chbakouras\CrudApiGenerator\Repository;

/**
 * @author Chrisostomos Bakouras
 */
abstract class BaseEloquentRepository implements EloquentRepository
{
    protected $query;

    public function __construct()
    {
        $this->query = resolve($this->model())
            ->newQuery();
    }

    abstract function model();

    function create(array $attributes)
    {
        return $this->query
            ->create($attributes);
    }

    function update(array $attributes, $id, $attribute = 'id')
    {
        $this->query
            ->where($attribute, '=', $id)
            ->update($attributes);

        return $this->find($id);
    }

    function with(array $relations)
    {
        return $this->query
            ->with($relations);
    }

    function where($field, $value)
    {
        return $this->query
            ->where($field, $value);
    }

    function applyQueryAttributes(array $attributes)
    {
        $query = $this->query;
        foreach ($attributes as $key => $attribute) {
            if ($attribute != null) {
                $query = $query->where($key, $attribute);
            }
        }

        return $query;
    }

    function findAll()
    {
        return $this->query
            ->get();
    }

    function findAllSorted($sort = 'id', $dir = 'asc')
    {
        return $this->query
            ->orderBy($sort, $dir)
            ->get();
    }

    function findAllPaginated($perPage = 20)
    {
        return $this->query
            ->paginate($perPage);
    }

    function findAllPaginatedSorted($perPage = 20, $sort = 'id', $dir = 'asc')
    {
        return $this->query
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
        return $this->query
            ->whereIn($this->query->getKeyName(), $ids)
            ->get();
    }

    function findOne($id)
    {
        return $this->query
            ->find($id);
    }

    function delete($model)
    {
        return $this->query
            ->destroy($model->getKey());
    }

    function deleteById($id)
    {
        return $this->query
            ->destroy($id);
    }

    function deleteInBatch(array $ids)
    {
        $this->query
            ->whereIn($this->query->getKeyName(), $ids)
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
        return $this->query->find($id)
            ? true
            : false;
    }

    function count()
    {
        return $this->query
            ->count();
    }
}
