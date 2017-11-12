<?php namespace Chbakouras\CrudApiGenerator\Request;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @author Chrisostomos Bakouras
 */
abstract class ApiRequest extends FormRequest
{
    /**
     * The data to be validated should be processed as JSON.
     * @return mixed
     */
    protected function validationData()
    {
        return $this->json()->all();
    }

    /**
     * Get request parameters
     *
     * @return array
     */
    abstract function getParameters();
}
