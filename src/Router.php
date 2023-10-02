<?php

namespace app;

use app\controllers;
use app\Request as AppRequest;

class Router
{
  protected $routes = [];

  function addRoute(string $route, $controller)
  {
    $this->routes[$route] = $controller;
  }

  public function dispatch()
  {
    $uri = AppRequest::getURL();
    $method = AppRequest::getMethod();
    $params = AppRequest::getParams();

    if (isset($this->routes[$uri])) {
      return $this->routes[$uri]->handle($method, $params);
    }
  }
}

// $r = new Router();

// $r->dispatch();
