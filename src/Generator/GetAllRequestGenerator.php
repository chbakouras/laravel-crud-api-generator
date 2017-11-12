<?php namespace Chbakouras\CrudApiGenerator\Generator;

/**
 * @author Chrisostomos Bakouras
 */
class GetAllRequestGenerator extends BaseGenerator
{
    function getStubPath()
    {
        return __DIR__ . '/../../template/request/get_all_request.stub';
    }

    function getGenerateFile()
    {
        return $this->variables['$GET_ALL_API_REQUEST_CLASS$'];
    }
}
