<?php

namespace app\repositories;

use app\base\BaseRepository;
use app\models\UserModel;
use PDO;

class UserRepository extends BaseRepository
{
  protected static $instance;
  protected $tableName = 'user';

  private function __construct()
  {
    parent::__construct();
  }

  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      self::$instance = new static();
    }
    return self::$instance;
  }

  public function getById($user_id)
  {
    return $this->findOne(['user_id' => [$user_id, PDO::PARAM_INT]]);
  }

  public function getByEmail($email)
  {
    return $this->findOne(['email' => [$email, PDO::PARAM_STR]]);
  }
  public function getByUsername($username)
  {
    return $this->findOne(['username' => [$username, PDO::PARAM_STR]]);
  }

  public function deleteById($user_id)
  {
    $user = $this->getById($user_id);
    $userModel = new UserModel();
    $userModel->constructFromArray($user);
    $this->CallAPI("deleteURL", getenv('rest_url') . "/user/{$user_id}", ["user_id" => $user_id]);
    return $this->delete($userModel);
  }

  // Method: POST, PUT, GET etc
  // Data: array("param" => "value") ==> index.php?param=value

  function CallAPI($method, $url, $data = [])
  {
    $curl = curl_init();

    switch ($method) {
      case "POST":
        curl_setopt($curl, CURLOPT_POST, 1);

        if ($data)
          curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        break;
      case "PUT":
        curl_setopt($curl, CURLOPT_PUT, 1);
        break;
      default:
        if ($data)
          $url = sprintf("%s?%s", $url, http_build_query($data));
    }


    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
  }
}
