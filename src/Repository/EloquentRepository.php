<?php namespace Chbakouras\CrudApiGenerator\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @author Chrisostomos Bakouras
 */
interface EloquentRepository extends GenericRepository
{
    /**
     * The Repository model class
     *
     * @return string
     */
    function model();

    /**
     * Creates a new model with attributes
     *
     * @param array $attributes
     * @return Model
     */
    function create(array $attributes);

    /**
     * Updates all models where the $attribute equals $id with attributes
     *
     * @param array $attributes
     * @param $id
     * @param string $attribute
     * @return Collection
     */
    function update(array $attributes, $id, $attribute = 'id');

    /**
     * Apply where to QueryBuilder for all attributes
     *
     * @param array $attributes
     * @return $this
     */
    function applyQueryAttributes(array $attributes);
}
