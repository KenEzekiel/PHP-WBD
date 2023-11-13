<?php

namespace app\controllers;

use app\base\BaseController;
use app\controllers\utils\response;
use app\Request;
use app\services\UserService;
use Exception;
use SoapHeader;

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
      parent::redirect("/");
    }
  }
  protected function post($urlParams)
  {
    $uri = Request::getURL();
    try {
      if ($uri == '/login') {
        $username_email = $_POST['username-email'];
        $password = $_POST['password'];
        $this->service->login($username_email, $password);
        if (isset($_SESSION['user_id'])) {
          // redirect
          parent::redirect("/");
        }
      }
      else {
        $rawData = file_get_contents('php://input');
        $jsonData = json_decode($rawData, true);
        $username_email = $jsonData['username-email'];
        $password = $jsonData['password'];
        $data = $this->service->loginPremium($username_email, $password);
        response::send_json_response($data);
      }
    } catch (Exception $e) {
      $msg = $e->getMessage();
      if ($uri == '/login') {
        parent::render(["errorMsg" => $msg], "login", "layouts/base");
      }
      else {
        $data["error_code"] = $msg;
        response::send_json_response($data, 401);
      }
    }
}
}
