<?php

namespace app\controllers;

use app\base\BaseController;
use app\exceptions\BadRequestException;
use app\models\FilmModel;
use app\models\UserModel;
use app\Request;
use app\services\FavoriteService;
use app\services\FilmService;
use app\services\ReviewService;
use app\services\UserService;
use Exception;

class ProfileController extends BaseController
{
    protected $favoriteService;
    protected $reviewService;
    protected $filmService;
  public function __construct()
  {
    parent::__construct(UserService::getInstance());
    $this->favoriteService = FavoriteService::getInstance();
    $this->reviewService = ReviewService::getInstance();
    $this->filmService = FilmService::getInstance();
  }

  protected function get($urlParams)
  {
      try
      {
          $uri = Request::getURL();
          $data = [];
          if ($uri == "/profile-user")
          {
              $user = $this->service->getById($_SESSION['user_id']);
              $data['email'] = $user->email;
              $data['username'] = $user->username;
          }
          else if ($uri == "/profile-favorites")
          {
              $favorites = $this->favoriteService->getUserFavoriteFilms(1);
              $films = [];
              foreach ($favorites as $fav) {
                  $films[] = $this->filmService->getById($fav["film_id"]);
              }
              $data["films"] = $films;
          }
          else if ($uri == "/profile-reviews")
          {
              $reviews = $this->reviewService->getUserReviews(1);
              echo "tess";
              var_dump($reviews);
              $data["reviews"] = $reviews;
          }
          parent::render($data, "profile", "layouts/base");
      } catch (Exception $e) {
            $msg = $e->getMessage();
            $urlParams['errorMsg'] = $msg;
            parent::render($urlParams, "profile", "layouts/base");
      }
  }

  protected function post($urlParams)
  {
    try {
      $user = $this->service->getById($_SESSION['user_id']);
      $old_pass = $user->password;

      $urlParams['email'] = $user->email;
      $urlParams['username'] = $user->username;

      // Get data
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = $_POST['password'] ? $_POST['password'] : $old_pass;
      $confirm_password = $_POST['confirm-password'] ? $_POST['confirm-password'] : $old_pass;

      // Check validity
      if ($this->service->isEmailExist($email) and $user->email != $email) {
        throw new BadRequestException("Email Already Exists!");
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new BadRequestException("Email is not valid!");
      }

      if ($this->service->isUsernameExist($username) and $user->username != $username) {
        throw new BadRequestException("Username Already Exists!");
      }

      if ($password != $confirm_password) {
        throw new BadRequestException("Password does not match!");
      }


      $user
        ->set('email', $email)
        ->set('username', $username)
        ->set('password', $_POST['password'] ? password_hash($password, PASSWORD_DEFAULT) : $password);

      // Call service
      $response = $this->service->update($user);
      $msg = "";

      if ($response != null) {
        $_SESSION['username'] = $username;
        $msg = "Successfully updated profile!";
      }

      // Render response
      parent::redirect("/", ["msg" => $msg]);
    } catch (Exception $e) {
      $msg = $e->getMessage();
      $urlParams['errorMsg'] = $msg;
      parent::render($urlParams, "profile", "layouts/base");
    }
  }
}
