<?php

namespace app\controllers;

use app\base\BaseController;
use app\controllers\utils\response;
use app\client\SoapClient;
use app\Request;
use Exception;

class SoapPremiumController extends BaseController
{
    private $soap_client;

    public function __construct()
    {
        parent::__construct(null);
        $this->soap_client = new SoapClient();
    }

    protected function get($urlParams)
    {
        // Get page for requesting premium
        if (!isset($_SESSION['user_id'])) {
            parent::redirect("/", $urlParams);
        } else {
            $registered = $this->soap_client->checkStatus(["userId" => (int)$_SESSION['user_id']]);
            if ($registered->userStatus == "UNREGISTERED") {
                $urlParams['registered'] = false;
            } else {
                $urlParams['registered'] = true;
            }
            parent::render($urlParams, "premium-status", "layouts/base");
        }
    }

    protected function post($urlParams)
    {
        $action = $_POST['action'];
        if ($action == 'register') {
            $response = $this->soap_client->registerPremium(["userId" => (int)$_SESSION['user_id'], "email" => (string)$_SESSION['user_email']]);
            if ($response->premiumRequest == "SUCCESS") {
                $urlParams['msg'] = "Registration successful";
            } else {
                $urlParams['msg'] = "Registration failed";
            }
        } else if ($action == 'cancel') {
            $response = $this->soap_client->cancelRegister(["userId" => (int)$_SESSION['user_id']]);
            if ($response->responseCancel == "SUCCESS") {
                $urlParams['msg'] = "Cancel premium request successful";
            } else {
                $urlParams['msg'] = "Cancel premium request failed";
            }
        }
        parent::redirect("/premium-status", $urlParams);
    }
}
