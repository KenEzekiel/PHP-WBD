<?php

namespace app;

class Request
{
  public static function getURL()
  {
    return parse_url($_SERVER['REQUEST_URI'])['path'];
  }

  public static function getMethod()
  {
    return $_SERVER['REQUEST_METHOD'];
  }

  public static function getParams()
  {
    $params = $_SERVER['REQUEST_URI'];
    $params = explode("?", $params);
    $params = array_slice($params, 1);
    if (empty($params)) {
      return [];
    }
    return $params;
  }
}
