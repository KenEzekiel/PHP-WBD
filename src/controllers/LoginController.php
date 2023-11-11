<?php

namespace app\controllers;

use app\base\BaseController;
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
    $apikey = getenv('api_key');
    // Stream context to add HTTP headers
    $streamContext = stream_context_create([
      'http' => [
        'header' => "Authorization: Bearer $apikey",
      ],
    ]);
    // Options for the SOAP client
    $options = [
      'stream_context' => $streamContext,
      'trace' => 1, // Enable trace to view request and response headers
      'cache_wsdl' => WSDL_CACHE_NONE
    ];
    $soapclient = new \SoapClient(getenv('soap_url'), $options);
    $params = ["userId" => 1];
    $check_example = $soapclient->cancelRegister($params);
    echo "<pre>";
    var_dump($check_example);
    echo "</pre>";
    // var_dump(phpinfo());

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
    $username_email = $_POST['username-email'];
    $password = $_POST['password'];
    try {
      $this->service->login($username_email, $password);
    } catch (Exception $e) {
      $msg = $e->getMessage();
      parent::render(["errorMsg" => $msg], "login", "layouts/base");
    }
    if (isset($_SESSION['user_id'])) {
      // redirect
      parent::redirect("/");
    }
  }
}
