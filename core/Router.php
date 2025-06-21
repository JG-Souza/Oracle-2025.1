<?php

namespace App\Core;
use Exception;

class Router
{
    /**
     * All registered routes.
     *
     * @var array
     */
    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Load a user's routes file.
     *
     * @param string $file
     */
    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    /**
     * Register a GET route.
     *
     * @param string $uri
     * @param string $controller
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Register a POST route.
     *
     * @param string $uri
     * @param string $controller
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Load the requested URI's associated controller method.
     *
     * @param string $uri
     * @param string $requestType
     */
public function direct($uri, $requestType)
{
    // Check for exact match first
    if (array_key_exists($uri, $this->routes[$requestType])) {
        return $this->callAction(
            ...explode('@', $this->routes[$requestType][$uri])
        );
    }

    // Check for dynamic routes like postIndividual/{id}
    foreach ($this->routes[$requestType] as $route => $controller) {
        // Convert route to regex pattern
        $pattern = preg_replace('#\{[a-zA-Z_]+\}#', '([a-zA-Z0-9_-]+)', $route);
        $pattern = "#^$pattern$#";

        if (preg_match($pattern, $uri, $matches)) {
            array_shift($matches); // remove full match
            $parts = explode('@', $controller);
            return $this->callAction($parts[0], $parts[1], $matches);
        }
    }

    throw new Exception('No route defined for this URI.');
}

    /**
     * Load and call the relevant controller action.
     *
     * @param string $controller
     * @param string $action
     */
protected function callAction($controller, $action, $params = [])
{
    $controller = "App\\Controllers\\{$controller}";
    $controller = new $controller;

    if (!method_exists($controller, $action)) {
        throw new Exception("{$controller} does not respond to the {$action} action.");
    }

    return call_user_func_array([$controller, $action], $params);
}

}