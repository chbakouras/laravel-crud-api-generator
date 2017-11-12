<?php namespace Chbakouras\CrudApiGenerator\Generator;

/**
 * @author Chrisostomos Bakouras
 */
class ResourceGenerator extends BaseGenerator
{
    function getStubPath()
    {
        return __DIR__ . '/../../template/resource/resource.stub';
    }

    function getGenerateFile()
    {
        return $this->variables['$RESOURCE_CLASS$'];
    }
}
