<?php

if (! function_exists('crud_api_config')) {
    function crud_api_config($key, $default = null)
    {
        return config()->get($key, $default);
    }
}
