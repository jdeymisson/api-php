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

  $routes->add('GET', '/payment', 'PaymentController@index');
  $routes->add('GET', '/payment/{id}', 'PaymentController@show');
  $routes->add('POST', '/payment', 'PaymentController@insert');
  $routes->add('PUT', '/payment', 'PaymentController@edit');
  $routes->add('DELETE', '/payment/{id}', 'PaymentController@delete');

  $routes->add('GET', '/sale', 'SaleController@index');
  $routes->add('GET', '/sale/{id}', 'SaleController@show');
  $routes->add('POST', '/sale', 'SaleController@insert');
  $routes->add('PUT', '/sale', 'SaleController@edit');
  $routes->add('DELETE', '/sale/{id}', 'SaleController@delete');

  return $routes;
  ?>

