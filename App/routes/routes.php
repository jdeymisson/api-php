<?php
  namespace App\routes;

  $routes = new \App\routes\Router();
  $routes->add('GET', '/client', 'ClientController@index');
  $routes->add('GET', '/client/{id}', 'ClientController@show');
  $routes->add('POST', '/client', 'ClientController@insert');
  $routes->add('PUT', '/client', 'ClientController@edit');
  $routes->add('DELETE', '/client/{id}', 'ClientController@delete');
  return $routes;
  ?>

