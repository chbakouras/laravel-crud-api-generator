<?php namespace Chbakouras\CrudApiGenerator\Repository;

use Chbakouras\CrudApiGenerator\Repository\Query\Where;
use Chbakouras\CrudApiGenerator\Repository\Query\WhereGroup;
use Chbakouras\CrudApiGenerator\Repository\Query\With;

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

        foreach ($attributes as $key => $value) {
            if ($value != null) {

                if ($value instanceof With) {
                    $query->with($value->getWiths());
                } else if ($value instanceof Where) {
                    $query = $this->applyWhere($query, $value);
                } else if ($value instanceof WhereGroup) {
                    $wheres = $value->getWheres();

                    if ($wheres && sizeof($wheres) > 0) {
                        $query = $query->where(function ($innerQuery) use (&$wheres, &$value) {
                            $firstWhere = array_shift($wheres);

                            $query = $this->applyWhere($innerQuery, $firstWhere);

                            foreach ($wheres as $where) {
                                if ($value->getOperator() === WhereGroup::AND) {
                                    $query = $this->applyWhere($query, $where);
                                } else if ($value->getOperator() === WhereGroup::OR) {
                                    $query = $this->applyOrWhere($query, $where);
                                }
                            }
                        });
                    }
                } else {
                    $query = $query->where($key, $value);
                }
            }
        }

        return $query;
    }

    private function applyWhere($query, Where $where) {
        return $query->where(
            $where->getColumn(),
            $where->getOperation(),
            $where->getValue()
        );
    }

    private function applyOrWhere($query, Where $where) {
        return $query->orWhere(
            $where->getColumn(),
            $where->getOperation(),
            $where->getValue()
        );
    }
}
