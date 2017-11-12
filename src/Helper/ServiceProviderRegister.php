<?php namespace Chbakouras\CrudApiGenerator\Helper;

use ReflectionClass;

/**
 * @author Chrisostomos Bakouras
 */
trait ServiceProviderRegister
{
    private function registerToServiceProvider($serviceProvider, $interface, $implementation)
    {
        $registerFunction = (new ReflectionClass($serviceProvider))->getMethod('register');
        $fileName = $registerFunction->getFileName();

        $source = file($fileName);

        $bindCode = "\t\t" . '$this->app->bind("' . $interface . '","' . $implementation . '");' . PHP_EOL;

        if (StringUtils::exists($source, $bindCode)) {
            return false;
        } else {
            array_splice($source, $registerFunction->getEndLine() - 1, 0, $bindCode);
            file_put_contents($fileName, implode('', $source));
            return true;
        }
    }
}
