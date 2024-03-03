<?php
  require_once './vendor/autoload.php';
  header('Content-Type: application/json');

  $method = $_SERVER['REQUEST_METHOD'];
  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $path = str_replace('/api', '', $path);

  $routes = include './App/routes/routes.php';
  $routes->handleRequest($method, $path);
?>
