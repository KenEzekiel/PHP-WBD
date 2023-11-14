<?php

namespace app\controllers;
use app\base\BaseController;
use app\controllers\utils\response;
use app\Request;
use app\models\SoapPremiumModel;
use Exception;

class SoapPremiumController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = SoapPremiumModel::getInstance();
    }

    public function checkStatus($params){
        return $this->model->checkStatus($params);
    }

    protected function get($urlParams)
    {
        $uri = Request::getURL();
        
        if($uri == '/premium-status'){
            if (isset($_SESSION['role']) and $_SESSION['role'] == 'admin'){
                $premiumTemp = $this->model->getAllPremium()->listUserPremium;
                if(!empty($premiumTemp)){
                    if(!is_array($premiumTemp)){
                        $premiumTemp = [$premiumTemp];
                    }
                    else{
                        $premiumTemp = $premiumTemp;
                    }
                    $data["premium_users"] = $premiumTemp;
                }

                $pendingTemp = $this->model->getAllPending()->listUserPending;
                if(!empty($pendingTemp)){
                    if(!is_array($pendingTemp)){
                        $pendingTemp = [$pendingTemp];
                    }
                    else{
                        $pendingTemp = $pendingTemp;
                    }
                    $data["pending_users"] = $pendingTemp;
                }
                parent::render($data, 'premium-status', "layouts/base");
            }
            else{
                $params = ["userId" => $_SESSION['user_id']];
                $result = $this->checkStatus($params);
                $data['userStatus'] = $result->userStatus;

                parent::render($data, 'premium-status', "layouts/base");
            }
        }
        else{
            throw new Exception("Invalid URL");
        }
    }

    protected function post($urlParams)
    {
        $uri = Request::getURL();
        
        if($uri == '/register-premium'){
            if(isset($_POST['email'])){
                $params = ["userId" => $_SESSION['user_id'], "email" => $_POST['email']];
                $result = $this->model->registerPremium($params);
                // if($result->status == "success"){
                    header("Location: /premium-status");
                // }
                // else{
                //     throw new Exception("Invalid Email");
                // }
            }
            else{
                throw new Exception("Invalid URL");
            }
        }

        elseif($uri == '/cancel-premium'){
            $params;
            if (isset($_SESSION['role']) and $_SESSION['role'] == 'admin')
                $params = ["userId" => $_POST['user_id']];
            else 
                $params = ["userId" => $_SESSION['user_id']];
            $result = $this->model->cancelRegister($params);
            // if($result->status == "success"){
                $data['premiumCancelMessage'] = $result->responseCancel;
                header("Location: /premium-status");
            // }
            // else{
            //     throw new Exception("Invalid URL");
            // }
        }
        elseif($uri == '/approve-premium'){
            $params = ["userId" => $_POST['user_id']];
            $result = $this->model->approvePremium($params);
            // if($result->status == "success"){
                $data['premiumAcceptMessage'] = $result->approvalResponse;
                header("Location: /premium-status");
            // }
            // else{
            //     throw new Exception("Invalid URL");
            // }
        }
        elseif($uri == '/reject-premium'){
            $params = ["userId" => $_POST['user_id']];
            $result = $this->model->rejectPremium($params);
            // if($result->status == "success"){
                $data['premiumRejectMessage'] = $result->rejectionResponse;
                header("Location: /premium-status");
            // }
            // else{
            //     throw new Exception("Invalid URL");
            // }
        }
    }
}