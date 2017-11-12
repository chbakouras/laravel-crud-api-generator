<?php namespace Chbakouras\CrudApiGenerator\Generator;

/**
 * @author Chrisostomos Bakouras
 */
class ServiceGenerator extends BaseGenerator
{
    function getStubPath()
    {
        return __DIR__ . '/../../template/service/interface.stub';
    }

    function getGenerateFile()
    {
        return $this->variables['$SERVICE_CLASS$'];
    }
}
