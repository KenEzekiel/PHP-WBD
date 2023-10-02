<?php

use app\App;
use app\base\BaseController;

spl_autoload_register(function ($className) {
  if (!str_starts_with($className, "app\\")) {
    return;
  }

  $className = substr($className, 4);
  $className = str_replace("\\", "/", $className);
  $class = __DIR__ . "/src/" . "{$className}.php";
  include_once($class);
});

$app = new App();
