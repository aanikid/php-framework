<?php

namespace App\Routes;


use App\Routes\Concerns\RouterHelper;
use Closure;

class Router
{
    use RouterHelper;

    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';

    public function get(string $path, Closure| string | array $handler): void
    {
        $this->addHandler(self::METHOD_GET, $path, $handler);
    }

    public function post(string $path, Closure| string | array $handler): void
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }

    public function run()
    {
        $this->routeManager();
    }
}
