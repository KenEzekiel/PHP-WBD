<?php

namespace app\controllers;

use app\base\BaseController;
use app\exceptions\BadRequestException;
use app\models\UserModel;
use app\Request;
use app\services\UserService;
use Exception;

class ProfileController extends BaseController
{
  public function __construct()
  {
    parent::__construct(UserService::getInstance());
  }

  protected function get($urlParams)
  {

    $user = $this->service->getById($_SESSION['user_id']);
    $urlParams['email'] = $user->email;
    $urlParams['username'] = $user->username;
    parent::render($urlParams, "profile", "layouts/base");
  }

  protected function post($urlParams)
  {
    try {
      $user = $this->service->getById($_SESSION['user_id']);
      $old_pass = $user->password;

      $urlParams['email'] = $user->email;
      $urlParams['username'] = $user->username;

      // Get data
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = $_POST['password'] ? $_POST['password'] : $old_pass;
      $confirm_password = $_POST['confirm-password'] ? $_POST['confirm-password'] : $old_pass;

      // Check validity
      if ($this->service->isEmailExist($email) and $user->email != $email) {
        throw new BadRequestException("Email Already Exists!");
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new BadRequestException("Email is not valid!");
      }

      if ($this->service->isUsernameExist($username) and $user->username != $username) {
        throw new BadRequestException("Username Already Exists!");
      }

      if ($password != $confirm_password) {
        throw new BadRequestException("Password does not match!");
      }


      $user
        ->set('email', $email)
        ->set('username', $username)
        ->set('password', $_POST['password'] ? password_hash($password, PASSWORD_DEFAULT) : $password);

      // Call service
      $response = $this->service->update($user);
      $msg = "";

      if ($response != null) {
        $_SESSION['username'] = $username;
        $msg = "Successfully updated profile!";
      }

      // Render response
      parent::redirect("/", ["msg" => $msg]);
    } catch (Exception $e) {
      $msg = $e->getMessage();
      $urlParams['errorMsg'] = $msg;
      parent::render($urlParams, "profile", "layouts/base");
    }
  }
}
