<?php namespace Chbakouras\CrudApiGenerator\Generator;

/**
 * @author Chrisostomos Bakouras
 */
class ApiControllerGenerator extends BaseGenerator
{
    function getStubPath()
    {
        return __DIR__ . '/../../template/controller/controller.stub';
    }

    function getGenerateFile()
    {
        return $this->variables['$CONTROLLER_CLASS$'];
    }
}
