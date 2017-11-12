<?php namespace Chbakouras\CrudApiGenerator\Generator;

/**
 * @author Chrisostomos Bakouras
 */
class ServiceImplGenerator extends BaseGenerator
{
    function getStubPath()
    {
        return __DIR__ . '/../../template/service/service.stub';
    }

    function getGenerateFile()
    {
        return $this->variables['$SERVICE_IMPL_CLASS$'];
    }
}
