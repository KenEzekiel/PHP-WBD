<?php

require_once PROJECT_ROOT_PATH . "/src/bases/BaseModel.php";

class UserModel extends BaseModel {
  public $user_id;
  public $email;
  public $username;
  public $password;
  public $role;

  public function __construct() {
    $this->_primary_key = 'user_id';
    return $this;
  }

  public function constructFromArray($array) {
    $this->user_id = $array['user_id'];
    $this->email = $array['email'];
    $this->username = $array['username'];
    $this->password = $array['password'];
    $this->role = $array['role'];
    return $this;
  }

  public function toResponse() {
    return array(
      'user_id' => $this->user_id,
      'email' => $this->email,
      'username' => $this->username,
      'role' => $this->role,
    );
  }

}