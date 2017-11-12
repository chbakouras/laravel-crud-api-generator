<?php namespace Chbakouras\CrudApiGenerator\Generator;

/**
 * @author Chrisostomos Bakouras
 */
class UpdateRequestGenerator extends BaseGenerator
{
    function getStubPath()
    {
        return __DIR__ . '/../../template/request/update_request.stub';
    }

    function getGenerateFile()
    {
        return $this->variables['$UPDATE_API_REQUEST_CLASS$'];
    }
}
