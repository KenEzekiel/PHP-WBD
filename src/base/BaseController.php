<?php

namespace app\base;

use app\exceptions\MethodNotAllowedException;

abstract class BaseController
{
  // ngasih tau layoutnya pake apa

  protected static $instance;
  protected $service;

  protected function __construct($service)
  {
    $this->service = $service;
  }

  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      self::$instance = new static(null);
    }
    return self::$instance;
  }

  protected function get($urlParams)
  {
    throw new MethodNotAllowedException("Method not allowed");
  }
  protected function post($urlParams)
  {
    throw new MethodNotAllowedException("Method not allowed");
  }
  protected function put($urlParams)
  {
    throw new MethodNotAllowedException("Method not allowed");
  }
  protected function delete($urlParams)
  {
    throw new MethodNotAllowedException("Method not allowed");
  }

  public function handle($method, $urlParams)
  {
    $to_lower_method = strtolower($method);
    echo $this->$to_lower_method($urlParams);
  }

  protected static function render($data, $view, $layout)
  {
    extract($data);
    ob_start();
    include_once __DIR__ . "/../../views/{$view}.php";
    $content = ob_get_clean();

    $data["__content"] = $content;
    extract($data);
    include_once __DIR__ . "/../../views/{$layout}.php";
  }
}
