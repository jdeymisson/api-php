<?php
namespace App\routes;

class Router {
    private $routes = [];

    public function add($method, $path, $controllerMethod) {
        $this->routes["$method $path"] = $controllerMethod;
    }

    public function get() {
        return $this->routes;
    }

    public function handleRequest($method, $path) {
        $path = str_replace('/', ' ', $path);
        $path = trim($path);
        $path = explode(" ", $path);
        $pathCount = count($path);
        $routeKey = "";
        $id = null;
        

        if (isset($path[1]) && is_numeric($path[1])) {
            $routeKey = $method ." /".$path[0]."/{id}";
            $id = $path[1];
        } elseif (isset($path[1]) && !is_numeric($path[1])) {
            $routeKey = $method ." /".$path[0]."/".$path[1];
        } else {
            $routeKey = $method ." /".$path[0];
        };
        
        if (array_key_exists($routeKey, $this->routes)) {
            list($controller, $method) = explode('@', $this->routes[$routeKey]);
            $namespaceController = '\\App\\controllers\\'.$controller;
            $instanciaController = new $namespaceController;

            if($id) {
                $instanciaController->$method($id);

            } else {
                $instanciaController->$method();
            };

        } else {
            http_response_code(404);
            echo json_encode(['error' => "Endpoint não encontrado!"],JSON_UNESCAPED_UNICODE);
        }
    }
}
?>
