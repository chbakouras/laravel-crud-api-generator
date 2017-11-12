<?php namespace Chbakouras\CrudApiGenerator\Request;

use Illuminate\Support\Facades\Input;

/**
 * @author Chrisostomos Bakouras
 */
trait Sort
{
    public function sort()
    {
        return Input::get(crud_api_config('sort.parameter-sort-name', 'sort'), crud_api_config('sort.parameter-sort-value', 'id'));
    }

    public function direction()
    {
        return Input::get(crud_api_config('sort.parameter-direction-name', 'dir'), crud_api_config('sort.parameter-direction-value', 'desc'));
    }
}
