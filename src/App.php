<?php

namespace app;

use app\Router;
use app\base\BaseController;
use app\controllers\LoginController;
use app\controllers\MainController;
use app\repositories\UserRepository;
use app\services\UserService;

class App
{
  protected $router;

  function __construct()
  {
    $this->router = new Router();
    $this->init_router();
    $this->router->dispatch();
  }

  function init_router()
  {

    $this->router->addRoute('/', MainController::class);
    $this->router->addRoute('/login', LoginController::class);
  }
}
