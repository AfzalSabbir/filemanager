
## Sa

```
Route::post('/admin/elfinder/{theme}', function (string $theme) {
    Session::put('file_manager_theme', $theme);
    Config::set('elfinder.default', $theme);
    Setting::query()->updateOrCreate(
        ['key' => 'file_manager_theme'],
        ['value' => $theme]
    );
});
```


            \Backpack\FileManager\Middleware\FileMangerMiddleware::class,