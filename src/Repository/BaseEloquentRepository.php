<?php namespace Chbakouras\CrudApiGenerator\Repository;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Chrisostomos Bakouras
 */
abstract class BaseEloquentRepository implements EloquentRepository
{
    /** @var Model */
    protected $model;

    public function __construct()
    {
        $this->model = resolve($this->model())
            ->newQuery();
    }

    abstract function model();

    function create(array $attributes)
    {
        return $this->model
            ->create($attributes);
    }

    function update(array $attributes, $id, $attribute = 'id')
    {
        $this->model
            ->where($attribute, '=', $id)
            ->update($attributes);

        return $this->find($id);
    }

    function with(array $relations)
    {
        $this->model = $this->model
            ->with($relations);

        return $this->model;
    }

    function where($field, $value)
    {
        $this->model = $this->model
            ->where($field, $value);

        return $this->model;
    }

    function applyQueryAttributes(array $attributes)
    {
        collect($attributes)
            ->filter(function ($value) {
                return $value != null;
            })
            ->each(function ($value, $field) {
                $this->where($field, $value);
            });

        return $this->model;
    }

    function findAll()
    {
        return $this->model
            ->get();
    }

    function findAllSorted($sort = 'id', $dir = 'asc')
    {
        return $this->model
            ->orderBy($sort, $dir)
            ->get();
    }

    function findAllPaginated($perPage = 20)
    {
        return $this->model
            ->paginate($perPage);
    }

    function findAllPaginatedSorted($perPage = 20, $sort = 'id', $dir = 'asc')
    {
        return $this->model
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
            ->whereIn($this->model->getKeyName(), $ids)
            ->get();
    }

    function findOne($id)
    {
        return $this->model
            ->find($id);
    }

    function delete($model)
    {
        return $this->model
            ->destroy($model->getKey());
    }

    function deleteById($id)
    {
        return $this->model
            ->destroy($id);
    }

    function deleteInBatch(array $ids)
    {
        $this->model
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
        return $this->model->find($id)
            ? true
            : false;
    }

    function count()
    {
        return $this->model
            ->count();
    }
}
