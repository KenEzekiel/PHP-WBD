<?php

namespace app\controllers;

use app\base\BaseController;
use app\exceptions\BadRequestException;
use app\services\UserService;
use Exception;

class UserDashboardController extends BaseController
{
  public function __construct()
  {
    parent::__construct(UserService::getInstance());
  }

  protected function get($urlParams)
  {
    if (!isset($_SESSION['role']) or $_SESSION['role'] != 'admin') {
      // TODO: make error controller
      parent::redirect("/error", [], 401);
      return;
    }
    $urlParams['users'] = $this->service->getAllUser();
    if (isset($urlParams['context']) and $urlParams['context'] == 'update') {
      $user = $this->service->getById($urlParams['user_id']);
      if ($urlParams['action'] == 'edit') {
        $urlParams['email'] = $user->email;
        $urlParams['username'] = $user->username;
        parent::render($urlParams, "update-user", "layouts/base");
      }
      if ($urlParams['action'] == 'delete') {
        $urlParams['username'] = $user->username;
        parent::render($urlParams, "delete-user", "layouts/base");
      }
      unset($urlParams['context']);
    } else {

      parent::render($urlParams, "user-dashboard", "layouts/base");
    }
  }

  protected function post($urlParams)
  {
    if (!isset($_SESSION['role']) or $_SESSION['role'] != 'admin') {
      parent::redirect("/error", [], 401);
      return;
    }
    if (isset($urlParams['context']) and $urlParams['context'] == 'update') {
      if ($urlParams['action'] == 'edit') {
        try {
          $user = $this->service->getById($urlParams['user_id']);
          $old_pass = $user->password;

          // Get data
          $email = $_POST['email'];
          $username = $_POST['username'];
          $password = $_POST['password'] ? $_POST['password'] : $old_pass;
          $confirm_password = $_POST['confirm-password'] ? $_POST['confirm-password'] : $old_pass;

          if ($this->service->isEmailExist($email) and $user->email != $email) {
            throw new BadRequestException("Email Already Exists!");
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

          if ($response == 1) {
            $msg = "User updated successfully!";
            $urlParams['msg'] = $msg;
          }

          // Unset the parameters
          unset($urlParams['context']);
          unset($urlParams['action']);
          unset($urlParams['user_id']);
          // Redirect to own link, but with no params
          parent::redirect("/user-dashboard", $urlParams);
        } catch (Exception $e) {
          $msg = $e->getMessage();
          $urlParams['errorMsg'] = $msg;
          parent::redirect("/user-dashboard", $urlParams);
        }
      }
      if ($urlParams['action'] == 'delete') {
        try {
          $user = $this->service->getById($urlParams['user_id']);
          $confirm_delete = $_POST['delete_confirm'];

          if ($confirm_delete == 'yes') {
            $response = $this->service->deleteById($user->user_id);
            if ($response == 1) {
              $msg = "User $user->username deleted successfully";
              $urlParams['msg'] = $msg;
            }
            // Unset the parameters
            unset($urlParams['context']);
            unset($urlParams['action']);
            unset($urlParams['user_id']);
            unset($urlParams['delete_confirm']);
            // Redirect to own link, but with no params
            parent::redirect("/user-dashboard", $urlParams);
          } else {
            // Unset the parameters
            unset($urlParams['context']);
            unset($urlParams['action']);
            unset($urlParams['user_id']);
            unset($urlParams['delete_confirm']);
            // Redirect to own link, but with no params
            parent::redirect("/user-dashboard", $urlParams);
          }
        } catch (Exception $e) {
          $msg = $e->getMessage();
          $urlParams['errorMsg'] = $msg;
          parent::redirect("/user-dashboard", $urlParams);
        }
      }
    } else {
      $action = $_POST['action'];
      $user_id = $_POST['user_id'];

      $urlParams = ['context' => 'update'];
      $urlParams['action'] = $action;
      $urlParams['user_id'] = $user_id;

      parent::redirect("/user-dashboard", $urlParams);
    }
  }
}
