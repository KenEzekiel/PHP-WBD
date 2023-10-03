<?php

namespace app\controllers;

use app\base\BaseController;
use app\Request;
use app\services\UserService;
use Exception;

class RegisterController extends BaseController
{
  public function __construct()
  {
    parent::__construct(UserService::getInstance());
  }

  protected function get($urlParams)
  {
    if (isset($_SESSION['user_id'])) {
      parent::redirect("/");
    } else {
      parent::render($urlParams, "register", "layouts/base");
    }
  }
  protected function post($urlParams)
  {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    try {
      $response = $this->service->register($username, $email, $password, $confirm_password);
    } catch (Exception $e) {
      $msg = $e->getMessage();
      parent::render(["errorMsg" => $msg], "register", "layouts/base");
    }
    parent::redirect("/login");
  }
}
