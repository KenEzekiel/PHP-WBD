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
      // If not admin
      parent::redirect("/error", [], 401);
      return;
    }
    // Get all users for the table
    $urlParams['users'] = $this->service->getAllUser();
    if (isset($urlParams['context']) and $urlParams['context'] == 'update') {
      // Context is updating
      $user = $this->service->getById($urlParams['user_id']);
      if ($urlParams['action'] == 'edit') {
        // action is editing data
        $urlParams['email'] = $user->email;
        $urlParams['username'] = $user->username;
        parent::render($urlParams, "update-user", "layouts/base");
      }
      if ($urlParams['action'] == 'delete') {
        // action is deleting data
        $urlParams['username'] = $user->username;
        parent::render($urlParams, "delete-user", "layouts/base");
      }
      unset($urlParams['context']);
    } else {
      // No context, only render the users list
      parent::render($urlParams, "user-dashboard", "layouts/base");
    }
  }

  protected function post($urlParams)
  {
    if (!isset($_SESSION['role']) or $_SESSION['role'] != 'admin') {
      // If not admin
      parent::redirect("/error", [], 401);
      return;
    }
    if (isset($urlParams['context']) and $urlParams['context'] == 'update') {
      // If context is set and the context is updating
      if ($urlParams['action'] == 'edit') {
        // If action is editing
        try {
          $user = $this->service->getById($urlParams['user_id']);
          $old_pass = $user->password;

          // Get data
          $email = $_POST['email'];
          $username = $_POST['username'];
          $password = $_POST['password'] ? $_POST['password'] : $old_pass;
          $confirm_password = $_POST['confirm-password'] ? $_POST['confirm-password'] : $old_pass;

          // Check validity
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


          if ($response) {
            $msg = "User Id $user->user_id updated successfully!";
            $urlParams['msg'] = $msg;
          }

          // Unset the parameters
          unset($urlParams['context']);
          unset($urlParams['action']);
          unset($urlParams['user_id']);
          unset($urlParams['errorMsg']);
          // Redirect to own link, but with no params
          parent::redirect("/user-dashboard", $urlParams);
        } catch (Exception $e) {
          $msg = $e->getMessage();
          $urlParams['errorMsg'] = $msg;
          // Redirect to own link, but with an error message of exception
          parent::redirect("/user-dashboard", $urlParams);
        }
      }
      if ($urlParams['action'] == 'delete') {
        // If action is deleting
        try {
          $user = $this->service->getById($urlParams['user_id']);
          $confirm_delete = $_POST['delete_confirm'];

          // If user has confirmed deletion
          if ($confirm_delete == 'yes') {
            // Call service
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
            unset($urlParams['errorMsg']);
            // Redirect to own link, but with no params
            parent::redirect("/user-dashboard", $urlParams);
          } else {
            // Unset the parameters
            unset($urlParams['context']);
            unset($urlParams['action']);
            unset($urlParams['user_id']);
            unset($urlParams['delete_confirm']);
            unset($urlParams['errorMsg']);
            // Redirect to own link, but with no params
            parent::redirect("/user-dashboard", $urlParams);
          }
        } catch (Exception $e) {
          $msg = $e->getMessage();
          $urlParams['errorMsg'] = $msg;
          // Redirect to own link, but with errorMsg
          parent::redirect("/user-dashboard", $urlParams);
        }
      }
    } else {
      // No context, waiting if edit or delete button clicked
      $action = $_POST['action'];
      $user_id = $_POST['user_id'];

      $urlParams = ['context' => 'update'];
      $urlParams['action'] = $action;
      $urlParams['user_id'] = $user_id;

      // Redirect to own link, but with url params of the context and action
      parent::redirect("/user-dashboard", $urlParams);
    }
  }
}
