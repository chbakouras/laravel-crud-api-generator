<?php namespace Chbakouras\CrudApiGenerator\Generator;

use Illuminate\Console\DetectsApplicationNamespace;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use ReflectionClass;

/**
 * @author Chrisostomos Bakouras
 */
abstract class BaseGenerator
{
    use DetectsApplicationNamespace;

    /* @var Filesystem */
    protected $filesystem;

    /* @var array */
    protected $variables;

    abstract function getStubPath();

    abstract function getGenerateFile();

    public function __construct($modelName)
    {
        $modelClass = BaseGenerator::getModelClass($modelName);

        $this->variables = [
            '$MODEL_NAME$' => $modelName,
            '$MODEL_PACKAGE$' => $modelClass,
            '$REPOSITORY_NAME$' => $modelName . crud_api_config('laravel_crud_api_generator.repositories.interface-name', 'Repository'),
            '$REPOSITORY_IMPL_NAME$' => $modelName . crud_api_config('laravel_crud_api_generator.repositories.implementation-name', 'RepositoryImpl'),
            '$REPOSITORY_CLASS$' => crud_api_config('laravel_crud_api_generator.repositories.package', 'App\Repositories\System') . '\\' . $modelName . crud_api_config('laravel_crud_api_generator.repositories.interface-name', 'Repository'),
            '$REPOSITORY_IMPL_CLASS$' => crud_api_config('laravel_crud_api_generator.repositories.package', 'App\Repositories\System') . '\\' . $modelName . crud_api_config('laravel_crud_api_generator.repositories.implementation-name', 'RepositoryImpl'),
            '$REPOSITORY_PACKAGE$' => crud_api_config('laravel_crud_api_generator.repositories.package', 'App\Repositories\System'),
            '$SERVICE_NAME$' => $modelName . crud_api_config('laravel_crud_api_generator.services.interface-name', 'CrudService'),
            '$SERVICE_IMPL_NAME$' => $modelName . crud_api_config('laravel_crud_api_generator.services.implementation-name', 'CrudServiceImpl'),
            '$SERVICE_CLASS$' => crud_api_config('laravel_crud_api_generator.services.package', 'App\Services\System') . '\\' . $modelName . crud_api_config('laravel_crud_api_generator.services.interface-name', 'CrudService'),
            '$SERVICE_IMPL_CLASS$' => crud_api_config('laravel_crud_api_generator.services.package', 'App\Services\System') . '\\' . $modelName . crud_api_config('laravel_crud_api_generator.services.implementation-name', 'CrudServiceImpl'),
            '$SERVICE_PACKAGE$' => crud_api_config('laravel_crud_api_generator.services.package', 'App\Services\System'),
            '$CONTROLLER_NAME$' => $modelName . crud_api_config('laravel_crud_api_generator.controllers.name', 'ApiController'),
            '$CONTROLLER_CLASS$' => crud_api_config('laravel_crud_api_generator.controllers.package', 'App\Http\Controllers\Api') . '\\' . $modelName . crud_api_config('laravel_crud_api_generator.controllers.name', 'ApiController'),
            '$CONTROLLER_PACKAGE$' => crud_api_config('laravel_crud_api_generator.controllers.package', 'App\Http\Controllers\Api'),
            '$REQUEST_PACKAGE$' => crud_api_config('laravel_crud_api_generator.requests.package', 'App\Http\Requests') . '\\' . $modelName,
            '$CREATE_API_REQUEST_NAME$' => 'Create' . $modelName . crud_api_config('laravel_crud_api_generator.requests.name', 'ApiRequest'),
            '$CREATE_API_REQUEST_CLASS$' => crud_api_config('laravel_crud_api_generator.requests.package', 'App\Http\Requests') . '\\' . $modelName . '\\' . 'Create' . $modelName . crud_api_config('laravel_crud_api_generator.requests.name', 'ApiRequest'),
            '$UPDATE_API_REQUEST_NAME$' => 'Update' . $modelName . crud_api_config('laravel_crud_api_generator.requests.name', 'ApiRequest'),
            '$UPDATE_API_REQUEST_CLASS$' => crud_api_config('laravel_crud_api_generator.requests.package', 'App\Http\Requests') . '\\' . $modelName . '\\' . 'Update' . $modelName . crud_api_config('laravel_crud_api_generator.requests.name', 'ApiRequest'),
            '$GET_ALL_API_REQUEST_NAME$' => 'GetAll' . $modelName . crud_api_config('laravel_crud_api_generator.requests.name', 'ApiRequest'),
            '$GET_ALL_API_REQUEST_CLASS$' => crud_api_config('laravel_crud_api_generator.requests.package', 'App\Http\Requests') . '\\' . $modelName . '\\' . 'GetAll' . $modelName . crud_api_config('laravel_crud_api_generator.requests.name', 'ApiRequest'),
            '$REQUEST_PARAMETERS$' => $this->createRequestParameters($modelClass),
            '$RESOURCE_NAME$' => $modelName . crud_api_config('laravel_crud_api_generator.resource.name', 'Resource'),
            '$RESOURCE_CLASS$' => crud_api_config('laravel_crud_api_generator.resource.package', 'App\Http\Resources') . '\\' . $modelName . crud_api_config('laravel_crud_api_generator.resource.name', 'Resource'),
            '$RESOURCE_PACKAGE$' => crud_api_config('laravel_crud_api_generator.resource.package', 'App\Http\Resources'),
            '$RESOURCE_PARAMETERS$' => $this->createResourceParameters($modelClass),
        ];
    }

    public static function getModelClass($modelName)
    {
        return crud_api_config('laravel_crud_api_generator.models.package', 'App\Models') . '\\' . $modelName;
    }

    public function generate()
    {
        $template = $this->getTemplate();
        $template = $this->fillTemplate($template);

        $path = $this->getPath();
        $this->createDirectoryIfNotExist(dirname($path));

        return file_put_contents($path, $template);
    }

    protected function getPath()
    {
        $name = Str::replaceFirst($this->getAppNamespace(), '', $this->getGenerateFile());

        return app_path() . '/' . str_replace('\\', '/', $name) . '.php';
    }

    public function createDirectoryIfNotExist($path, $replace = false)
    {
        if (file_exists($path) && $replace) {
            rmdir($path);
        }
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
    }

    public function getTemplate()
    {
        return file_get_contents($this->getStubPath());
    }

    public function fillTemplate($template)
    {
        foreach ($this->variables as $variable => $value) {
            $template = str_replace($variable, $value, $template);
        }

        return $template;
    }

    private function createRequestParameters($modelClass)
    {
        $reflectionClass = new ReflectionClass($modelClass);
        $model = $reflectionClass->newInstance();
        $columns = Schema::getColumnListing($model->getTable());

        $lines = [];
        foreach ($columns as $column) {
            array_push($lines, "\t\t\t" . '"' . $column . '" => ' . '$this->input("' . camel_case($column) . '"),' . PHP_EOL);
        }

        return implode("", $lines);
    }

    private function createResourceParameters($modelClass)
    {
        $reflectionClass = new ReflectionClass($modelClass);
        $model = $reflectionClass->newInstance();
        $columns = Schema::getColumnListing($model->getTable());

        $lines = [];
        foreach ($columns as $column) {
            array_push($lines, "\t\t\t" . '"' . camel_case($column) . '" => ' . '$this->' . $column . ',' . PHP_EOL);
        }

        return implode("", $lines);
    }
}
