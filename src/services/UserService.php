<?php

namespace app\services;

use app\base\BaseService;
use app\exceptions\BadRequestException;
use app\models\UserModel;
use app\repositories\UserRepository;
use PDO;

class UserService extends BaseService
{
  protected static $instance;

  private function __construct($repository)
  {
    parent::__construct();
    $this->repository = $repository;
  }

  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      self::$instance = new static(
        UserRepository::getInstance()
      );
    }
    return self::$instance;
  }

  public function getAllUser()
  {
    $allUser = $this->repository->findAll();
    $users = [];
    foreach ($allUser as $userData) {
      $user = new UserModel();
      $users[] = $user->constructFromArray($userData);
    }
    return $users;
  }

  public function register($username, $email, $password, $confirm_password)
  {
    // Check Password and Confirm Password
    if ($password !== $confirm_password) {
      throw new BadRequestException("Password does not match");
    }

    if ($this->isUsernameExist($username) and $this->isEmailExist($email)) {
      $user = new UserModel();
      $user->set('email', $email)->set('username', $username)->set('password', password_hash($password, PASSWORD_DEFAULT))->set('role', 'User');

      $id = $this->repository->insert($user, array(
        'email' => PDO::PARAM_STR,
        'username' => PDO::PARAM_STR,
        'password' => PDO::PARAM_STR,
        'role' => PDO::PARAM_STR
      ));
      // Get id
      $response = $this->repository->getById($id);
      $user = new UserModel();

      return $user->constructFromArray($response);
    } else {
      throw new BadRequestException("Username or Email already exists!");
    }
  }

  public function login($email_or_username, $password)
  {
    $user = null;

    // Check email first
    $userEmail = $this->getByEmail($email_or_username);
    if ($userEmail and !is_null($userEmail->get('user_id'))) {
      $user = $userEmail;
    }

    // Check for username
    if (is_null($user)) {
      $userUsername = $this->getByUsername($email_or_username);
      if ($userUsername and !is_null($userUsername->get('user_id'))) {
        $user = $userUsername;
      }
    }

    if (is_null($user)) {
      throw new BadRequestException("Email or Username is not found!");
    }

    if (!password_verify($password, $user->get('password'))) {
      throw new BadRequestException("Password is incorrect!");
    }

    $_SESSION["user_id"] = $user->get('user_id');
    $_SESSION["role"] = $user->get('role');

    return $user;
  }

  public function create($email, $username, $password, $role)
  {
    // $user = (new UserModel())->set('nama', $nama)->set('username', $username)->set('email', $email)->set('password', password_hash($password, PASSWORD_DEFAULT));
    $user = new UserModel();
    $user->set('email', $email)->set('username', $username)->set('password', password_hash($password, PASSWORD_DEFAULT))->set('role', $role);

    $id = $this->repository->insert($user, array(
      'email' => PDO::PARAM_STR,
      'username' => PDO::PARAM_STR,
      'password' => PDO::PARAM_STR,
      'role' => PDO::PARAM_STR
    ));

    $response = $this->repository->getById($id);
    $user = new UserModel();
    $userArray = $user->constructFromArray($response);

    $_SESSION["user_id"] = $userArray->user_id;
    $_SESSION["role"] = $userArray->role;

    return $userArray;
  }

  // Wrapper get by email from repository
  public function getByEmail($email)
  {
    $user = new UserModel();
    $response = $this->repository->getByEmail($email);
    if ($response) {
      $user->constructFromArray($response);
    }

    return $user;
  }

  // Wrapper get by username from repository
  public function getByUsername($username)
  {
    $user = new UserModel();
    $response = $this->repository->getByUsername($username);
    if ($response) {
      $user->constructFromArray($response);
    }

    return $user;
  }

  public function isUsernameExist($username)
  {
    $user = $this->getByUsername($username);
    return !is_null($user->get('user_id'));
  }

  public function isEmailExist($email)
  {
    $user = $this->getByEmail($email);
    return !is_null($user->get('user_id'));
  }

  public function getById($id)
  {
    $user = $this->repository->getById($id);

    if ($user) {
      $userModel = new UserModel();
      $userModel->constructFromArray($user);
      return $userModel;
    }

    return null;
  }
}
