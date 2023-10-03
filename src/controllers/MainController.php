<?php

namespace app\controllers;

use app\base\BaseController;
use Exception;

class MainController extends BaseController
{

  public function __construct()
  {
    parent::__construct(null);
  }

  protected function get($urlParams)
  {
    parent::render($urlParams, "home", "layouts/base");
  }
}
