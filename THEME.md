## Now in `app\Http\Middleware\FileMangerMiddleware`

Add this line in $middlewareGroups['web]

```
protected $middlewareGroups = [
        'web' => [
            ...
            \Backpack\FileManager\Middleware\FileMangerMiddleware::class,
            ...
        ],
    ];
    
```