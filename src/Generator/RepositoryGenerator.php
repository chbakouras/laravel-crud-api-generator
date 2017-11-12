<?php namespace Chbakouras\CrudApiGenerator\Generator;

/**
 * @author Chrisostomos Bakouras
 */
class RepositoryGenerator extends BaseGenerator
{
    function getStubPath()
    {
        return __DIR__ . '/../../template/repository/interface.stub';
    }

    function getGenerateFile()
    {
        return $this->variables['$REPOSITORY_CLASS$'];
    }
}
