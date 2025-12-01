<?php
namespace Static\Core;

use Static\Core\Response;

class Kernel
{
    public function __construct(private Router $router) {}

    public function run(): void
    {
        // Obtener método y URI real
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $uri = parse_url($uri, PHP_URL_PATH) ?: '/';

        // Normalizar "/" y "/index.php"
        if ($uri === '' || $uri === '/index.php') {
            $uri = '/';
        }

        // Buscar ruta
        $match = $this->router->match($method, $uri);

        if (!$match) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        $route  = $match['route'];
        $params = array_values($match['params']);

        // Ejecutar middlewares
        foreach ($route['middleware'] as $mw) {

            // Caso especial: ACL, recibe roles permitidos
            if ($mw === \Static\Middle\AclMiddleware::class) {
                (new $mw($route['acl']))->handle();
            } else {
                // Middlewares sin parámetros
                (new $mw())->handle();
            }
        }

        // Instanciar handler
        $handler = new $route['handler']();

        if (!$handler instanceof HandlerInterface) {
            throw new \RuntimeException("Handler debe implementar HandlerInterface.");
        }

        // Ejecutar handler con parámetros
        $result = $handler->handle(...$params);

        // Interpretación automática del resultado
        if (is_string($result)) {
            echo Response::html($result);
            return;
        }

        if (is_array($result)) {
            echo Response::json($result);
            return;
        }

        // Si el handler ya manejó la salida → null
        if ($result === null) {
            return;
        }

        echo Response::text("Tipo de respuesta no soportado.");
    }
}
