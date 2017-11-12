<?php namespace Chbakouras\CrudApiGenerator\Command;

use Chbakouras\CrudApiGenerator\Generator\ApiControllerGenerator;
use Chbakouras\CrudApiGenerator\Generator\CreateRequestGenerator;
use Chbakouras\CrudApiGenerator\Generator\GetAllRequestGenerator;
use Chbakouras\CrudApiGenerator\Generator\RepositoryGenerator;
use Chbakouras\CrudApiGenerator\Generator\RepositoryImplGenerator;
use Chbakouras\CrudApiGenerator\Generator\ResourceGenerator;
use Chbakouras\CrudApiGenerator\Generator\ServiceGenerator;
use Chbakouras\CrudApiGenerator\Generator\ServiceImplGenerator;
use Chbakouras\CrudApiGenerator\Generator\UpdateRequestGenerator;
use Chbakouras\CrudApiGenerator\Helper\CrudApiRoutes;
use Chbakouras\CrudApiGenerator\Helper\ServiceProviderRegister;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Chrisostomos Bakouras
 */
class MakeCrudApiCommand extends Command
{
    use ServiceProviderRegister, CrudApiRoutes;

    protected $signature = 'make:crud-api {name}';
    protected $description = 'Create a new repository class';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');

        $this->generateRepository($name);
        $this->generateService($name);
        $this->generateRequests($name);
        $this->generateController($name);
    }

    private function generateRepository($name)
    {
        $repositoryGenerator = new RepositoryGenerator($name);
        $repositoryGenerator->generate();

        $repositoryImplGenerator = new RepositoryImplGenerator($name);
        $repositoryImplGenerator->generate();

        $this->registerToServiceProvider(
            crud_api_config('laravel_crud_api_generator.repositories.service-provider', 'App\Providers\AppServiceProvider'),
            $repositoryGenerator->getGenerateFile(),
            $repositoryImplGenerator->getGenerateFile()
        );
    }

    private function generateService($name)
    {
        $serviceGenerator = new ServiceGenerator($name);
        $serviceGenerator->generate();

        $serviceImplGenerator = new ServiceImplGenerator($name);
        $serviceImplGenerator->generate();

        $this->registerToServiceProvider(
            crud_api_config('laravel_crud_api_generator.services.service-provider', 'App\Providers\AppServiceProvider'),
            $serviceGenerator->getGenerateFile(),
            $serviceImplGenerator->getGenerateFile()
        );
    }

    private function generateController($name)
    {
        $apiControllerGenerator = new ApiControllerGenerator($name);
        $apiControllerGenerator->generate();

        $this->addCrudApiRoute($name);
    }

    private function generateRequests($name)
    {
        $getAllRequestGenerator = new GetAllRequestGenerator($name);
        $getAllRequestGenerator->generate();

        $createRequestGenerator = new CreateRequestGenerator($name);
        $createRequestGenerator->generate();

        $updateRequestGenerator = new UpdateRequestGenerator($name);
        $updateRequestGenerator->generate();
    }
}
