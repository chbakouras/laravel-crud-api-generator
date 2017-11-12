<?php namespace Chbakouras\CrudApiGenerator\Helper;

/**
 * @author Chrisostomos Bakouras
 */
class StringUtils
{
    /**
     * Returns true if $needle exists in $haystack
     *
     * @param array $haystack
     * @param string $needle
     * @return boolean
     */
    static public function exists(array $haystack, $needle)
    {
        foreach ($haystack as $line) {
            if (stripos(trim($needle), trim($line)) !== false) {
                return true;
            }
        }

        return false;
    }
}
