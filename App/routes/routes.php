<?php
  namespace App\routes;

  $routes = new \App\routes\Router();

  $routes->add('GET', '/client', 'ClientController@index');
  $routes->add('GET', '/client/{id}', 'ClientController@show');
  $routes->add('POST', '/client', 'ClientController@insert');
  $routes->add('PUT', '/client', 'ClientController@edit');
  $routes->add('DELETE', '/client/{id}', 'ClientController@delete');


  $routes->add('GET', '/product', 'ProductController@index');
  $routes->add('GET', '/product/{id}', 'ProductController@show');
  $routes->add('POST', '/product', 'ProductController@insert');
  $routes->add('PUT', '/product', 'ProductController@edit');
  $routes->add('DELETE', '/product/{id}', 'ProductController@delete');

  return $routes;
  ?>

