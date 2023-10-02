<?php

namespace app\controllers;

use app\base\BaseController;
use app\services\UserService;
use Exception;

class LoginController extends BaseController
{
  public function __construct()
  {
    parent::__construct(null);
  }

  protected function get($urlParams)
  {
    try {
      parent::render($urlParams, "login", "layouts/base");
    } catch (Exception $e) {
      echo $e;
    }
  }
  protected function post($urlParams)
  {
    try {
      parent::put($urlParams);
    } catch (Exception $e) {
      echo $e;
    }
  }
  protected function put($urlParams)
  {
    try {
      parent::put($urlParams);
    } catch (Exception $e) {
      echo $e;
    }
  }
  protected function delete($urlParams)
  {
    try {
      parent::delete($urlParams);
    } catch (Exception $e) {
      echo $e;
    }
  }
}
