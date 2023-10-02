<?php

namespace app\controllers;

use app\base\BaseController;
use app\exceptions\MethodNotAllowedException;
use Exception;

class MainController extends BaseController
{

  protected function __construct()
  {
    parent::__construct(null);
  }

  protected function get($urlParams)
  {
    try {
      // parent::get($urlParams);

      // echo "params is ";
      // var_dump($urlParams);
      parent::render($urlParams, "home", "layouts/base");
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
