<?php

namespace app\base;

abstract class BaseService
{
  protected static $instance;
  protected $repository;

  protected function __construct()
  {
  }

  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      self::$instance = new static();
    }
    return self::$instance;
  }
}
