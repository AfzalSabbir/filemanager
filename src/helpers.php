<?php

// elfinder_theme
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