<?php
    namespace app\models;
    use app\base\BaseModel;

    class SoapPremiumModel
    {
        private $soapclient;
        private static $instance = null;

        public function __construct()
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
            $this->soapclient = new \SoapClient(getenv('soap_url'), $options);
        }
        public static function getInstance(){
            if (self::$instance == null) {
                self::$instance = new SoapPremiumModel();
            }
            return self::$instance;
        }
        public function registerPremium($params)
        {
            return $this->soapclient->registerPremium($params);
        }
        public function checkStatus($params)
        {
            return $this->soapclient->checkStatus($params);
        }
        public function cancelRegister($params){
            return $this->soapclient->cancelRegister($params);
        }
        public function approvePremium($params){
            return $this->soapclient->approvePremium($params);
        }
        public function getAllPremium($params){
            return $this->soapclient->getAllPremium($params);
        }
        public function getAllPending($params){
            return $this->soapclient->getAllPending($params);
        }
    }