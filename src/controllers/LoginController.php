<?php

namespace app\controllers;

use app\base\BaseController;
use app\Request;
use app\services\UserService;
use Exception;

class LoginController extends BaseController
{
  public function __construct()
  {
    parent::__construct(UserService::getInstance());
  }

  protected function get($urlParams)
  {

    $uri = Request::getURL();
    if ($uri == "/login") {
      if (isset($_SESSION['user_id'])) {
        // redirect
        parent::redirect("/");
      } else {
        parent::render($urlParams, "login", "layouts/base");
      }
    } else if ($uri == "/logout") {
      $this->service->logout();
      parent::redirect("/login");
    }
  }
  protected function post($urlParams)
  {
    $username_email = $_POST['username-email'];
    $password = $_POST['password'];
    $this->service->login($username_email, $password);
    if (isset($_SESSION['user_id'])) {
      // redirect
      parent::redirect("/");
    }
  }
}
