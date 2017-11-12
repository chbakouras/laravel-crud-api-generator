<?php namespace Chbakouras\CrudApiGenerator\Generator;

/**
 * @author Chrisostomos Bakouras
 */
class CreateRequestGenerator extends BaseGenerator
{
    function getStubPath()
    {
        return __DIR__ . '/../../template/request/create_request.stub';
    }

    function getGenerateFile()
    {
        return $this->variables['$CREATE_API_REQUEST_CLASS$'];
    }
}
