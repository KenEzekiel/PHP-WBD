<?php

namespace app;

use app\controllers;
use app\Request as AppRequest;

class Router
{
  protected $routes = [];

  function addRoute(string $route, $controller)
  {
    var_dump($controller);
    $this->routes[$route] = $controller;
  }

  public function dispatch()
  {
    $uri = AppRequest::getURL();
    $method = AppRequest::getMethod();
    $params = AppRequest::getParams();

    var_dump($this->routes);
    if (isset($this->routes[$uri])) {
      // var_dump($this->routes[$uri]);
      $controllerClass = $this->routes[$uri];
      $class = new $controllerClass();
      return $class->handle($method, $params);
    }
  }
}

// $r = new Router();

// $r->dispatch();
