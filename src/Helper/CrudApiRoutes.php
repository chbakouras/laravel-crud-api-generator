<?php namespace Chbakouras\CrudApiGenerator\Helper;

/**
 * @author Chrisostomos Bakouras
 */
trait CrudApiRoutes
{
    private function addCrudApiRoute($name)
    {
        $kebabName = kebab_case($name);
        $pluralKebabName = str_plural($kebabName);

        $routeFilePath = base_path(crud_api_config('routes.crud-route-file', 'routes/api.php'));
        $source = file($routeFilePath);

        $controllerName = $name . crud_api_config('controllers.name', 'ApiController');

        $routeCode = '$this->middleware("api")->namespace("' . crud_api_config('controllers.route-namespace', 'Api') . '")->name("api.")->group(function () {' . PHP_EOL .
            "\t" . '$this->get("/' . $pluralKebabName . '", "' . $controllerName . '@getAll")->name("' . $pluralKebabName . '.index");' . PHP_EOL .
            "\t" . '$this->get("/' . $pluralKebabName . '/{id}", "' . $controllerName . '@getOne")->name("' . $pluralKebabName . '.show");' . PHP_EOL .
            "\t" . '$this->post("/' . $pluralKebabName . '", "' . $controllerName . '@post")->name("' . $pluralKebabName . '.create");' . PHP_EOL .
            "\t" . '$this->put("/' . $pluralKebabName . '/{id}", "' . $controllerName . '@put")->name("' . $pluralKebabName . '.update");' . PHP_EOL .
            "\t" . '$this->delete("/' . $pluralKebabName . '/{id}", "' . $controllerName . '@delete")->name("' . $pluralKebabName . '.delete");' . PHP_EOL .
            '});' . PHP_EOL;

        array_splice($source, sizeof($source), 0, $routeCode);
        file_put_contents($routeFilePath, implode('', $source));
    }
}
