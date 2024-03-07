<?php
  require_once './vendor/autoload.php';
  header('Content-Type: application/json');
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
  header("Access-Control-Allow-Headers: *");

  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      http_response_code(204);
      exit();
  }

  $method = $_SERVER['REQUEST_METHOD'];
  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $path = str_replace('/api', '', $path);

  $routes = include './App/routes/routes.php';
  $routes->handleRequest($method, $path);
?>
