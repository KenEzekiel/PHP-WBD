<?php

namespace app\controllers;

use app\base\BaseController;
use app\controllers\utils\response;
use app\Request;
use app\services\UserService;
use Exception;

class AdminController extends BaseController
{
  public function __construct()
  {
    parent::__construct(UserService::getInstance());
  }

  protected function get($urlParams)
  {
    $admins = $this->service->getAllAdmin();
    $admin_emails = [];
    foreach ($admins as $data) {
      array_push($admin_emails, $data['email']);
    }
    response::send_json_response($admin_emails);
  }
}
