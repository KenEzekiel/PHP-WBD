<?php

namespace app\controllers;
use app\base\BaseController;
use app\controllers\utils\response;
use app\Request;
use app\models\SoapPremiumModel;
use Exception;

class SoapPremiumController extends BaseController {
    public $model;
    // public $soap_client;

    public function __construct() {
        $this->model = SoapPremiumModel::getInstance();
        // $this->soap_client = $this->model->getSoapClient();
    }

    public function checkStatus($params){
        return $this->model->checkStatus($params);
    }

    protected function get($urlParams)
    {
        $uri = Request::getURL();
        
        if($uri == '/premium-status'){
            $params = ["userId" => 1];
            $result = $this->checkStatus($params);
            // response::send_json_response($result->userStatus);
            $data['userStatus'] = $result->userStatus;

            parent::render($data, 'premium-status', "layouts/base");
        }
        else{
            throw new Exception("Invalid URL");
        }
    }

    protected function post($urlParams)
    {
        
    }
}