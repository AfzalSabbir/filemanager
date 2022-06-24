<?php

// elfinder theme
if (!function_exists('elfinder_theme')) {
    /**
     * @param string $resourceType
     * @return string
     */
    function elfinder_theme(string $resourceType): string
    {
        $resourceType = $resourceType ?? 'css';
        //elfinder_theme
        return config("elfinder.themes." . config('elfinder.default') . ".$resourceType")
               ?? config('elfinder.themes.backpack.default.' . $resourceType);
    }
}

// check if middleware resolved
if (!function_exists('check_if_middleware_resolved')) {
    /**
     * @param $app
     * @return bool
     */
    function check_if_middleware_resolved($app): bool
    {
        return $app->resolved(config('elfinder.middleware'));
    }
}