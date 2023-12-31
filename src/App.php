<?php

namespace app;

use app\controllers\FilmController;
use app\Router;
use app\base\BaseController;
use app\controllers\CreateFilmController;
use app\controllers\LoginController;
use app\controllers\MainController;
use app\controllers\ProfileController;
use app\controllers\ReviewController;
use app\controllers\RegisterController;
use app\controllers\UpdateFilmController;
use app\controllers\UserDashboardController;
use app\controllers\SoapPremiumController;
use app\controllers\AdminController;
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
    $this->router->addRoute('/login-premium', LoginController::class);
    $this->router->addRoute('/review', ReviewController::class);
    $this->router->addRoute('/logout', LoginController::class);
    $this->router->addRoute('/register', RegisterController::class);
    $this->router->addRoute('/films', FilmController::class);
    $this->router->addRoute('/film-details', FilmController::class);
    $this->router->addRoute('/film-polling', FilmController::class);
    $this->router->addRoute('/film-image', FilmController::class);
    $this->router->addRoute('/search', FilmController::class);
    $this->router->addRoute('/add-film', CreateFilmController::class);
    $this->router->addRoute('/update-film', UpdateFilmController::class);
    $this->router->addRoute('/profile', ProfileController::class);
    $this->router->addRoute('/my-favorites', ProfileController::class);
    $this->router->addRoute('/my-reviews', ProfileController::class);
    $this->router->addRoute('/user-dashboard', UserDashboardController::class);
    $this->router->addRoute('/premium-status', SoapPremiumController::class);
    $this->router->addRoute('/register-premium', SoapPremiumController::class);
    $this->router->addRoute('/cancel-premium', SoapPremiumController::class);
    $this->router->addRoute('/approve-premium', SoapPremiumController::class);
    $this->router->addRoute('/reject-premium', SoapPremiumController::class);
    $this->router->addRoute('/admins', AdminController::class);
  }
}
