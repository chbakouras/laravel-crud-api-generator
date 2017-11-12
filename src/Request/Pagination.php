<?php namespace Chbakouras\CrudApiGenerator\Request;

use Illuminate\Support\Facades\Input;

/**
 * @author Chrisostomos Bakouras
 */
trait Pagination
{
    public function size()
    {
        return Input::get(crud_api_config('pagination.parameter-size-name', 'size'), crud_api_config('pagination.parameter-size-value', 20));
    }
}
