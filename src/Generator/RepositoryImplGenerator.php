<?php namespace Chbakouras\CrudApiGenerator\Generator;

/**
 * @author Chrisostomos Bakouras
 */
class RepositoryImplGenerator extends BaseGenerator
{
    function getStubPath()
    {
        return __DIR__ . '/../../template/repository/repository.stub';
    }

    function getGenerateFile()
    {
        return $this->variables['$REPOSITORY_IMPL_CLASS$'];
    }
}
