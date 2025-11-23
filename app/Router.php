<?php
class Router {
    private static $routes = [];

    public static function get($path, $action, $middleware = null) {
        self::$routes['GET'][$path] = ['action' => $action, 'middleware' => $middleware];
    }

    public static function post($path, $action, $middleware = null) {
        self::$routes['POST'][$path] = ['action' => $action, 'middleware' => $middleware];
    }

    public static function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = strtok($_SERVER['REQUEST_URI'], "?");

        if (!isset(self::$routes[$method][$uri])) {
            http_response_code(404);
            echo "404 Not Found";
            exit;
        }

        $route = self::$routes[$method][$uri];
        list($controllerName, $methodName) = explode("@", $route["action"]);
        $controller = new $controllerName();

        if ($route['middleware']) {
            Middleware::{$route['middleware']}(
                fn() => $controller->{$methodName}()
            );
        } else {
            $controller->{$methodName}();
        }
    }
}
