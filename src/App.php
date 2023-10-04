<?php

namespace app;

use app\controllers\FilmController;
use app\Router;
use app\base\BaseController;
use app\controllers\CreateFilmController;
use app\controllers\LoginController;
use app\controllers\MainController;
use app\controllers\ReviewController;
use app\controllers\RegisterController;
use app\controllers\UpdateFilmController;
use app\repositories\UserRepository;
use app\repositories\ReviewRepository;
use app\services\UserService;
use app\services\ReviewService;

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
    $this->router->addRoute('/review', ReviewController::class);
    $this->router->addRoute('/logout', LoginController::class);
    $this->router->addRoute('/register', RegisterController::class);
    $this->router->addRoute('/films', FilmController::class);
    $this->router->addRoute('/search', FilmController::class);
    $this->router->addRoute('/add-film', CreateFilmController::class);
    $this->router->addRoute('/update-film', UpdateFilmController::class);
  }
}
