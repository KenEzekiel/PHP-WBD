<?php

namespace app\controllers\utils;

class response
{
    public static function send_json_response($data = [], $status_code = 200) {
        http_response_code($status_code);
        header('Content-Type: application/json');

        $response = [
            'status' => $status_code,
            'data' => $data,
        ];

        echo json_encode($response);
    }
}