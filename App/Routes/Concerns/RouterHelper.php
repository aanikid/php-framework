<?php

namespace App\Routes\Concerns;

use Closure;

trait RouterHelper
{
    public array $handlers;
    public Closure $notFoundHandler;

    public function addHandler(string $method, string $path, $handler): void
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public function addNotFoundHandler(Closure $handler): void
    {
        $this->notFoundHandler = $handler;
    }

    public function routeManager(): void
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];
        $callback = null;

        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $requestPath && $method === $handler['method']) {
                $callback = $handler['handler'];
            }
        }

        if (is_array($callback)) {
            $className = array_shift($callback);
            $handler = new $className;
            $method = array_shift($callback) ?? null;
            if (null !== $method) {
                $callback = [$handler, $method];
            }
        }

        if (is_string($callback)) {
            $className = $callback;
            $handler = new $className;
            $callback = [$handler, '__invoke'];
        }

        if (!$callback) {
            if (!empty($this->notFoundHandler)) {
                $callback = $this->notFoundHandler;
            }
        }

        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }

}