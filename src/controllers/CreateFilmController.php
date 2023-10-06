<?php

namespace app\controllers;

use app\base\BaseController;
use app\exceptions\BadRequestException;
use app\Request;
use app\services\FilmService;
use app\services\UserService;
use Exception;

class CreateFilmController extends BaseController
{
  public function __construct()
  {
    parent::__construct(FilmService::getInstance());
  }

  private function is_image($filename)
  {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $imgExtArr = ['jpg', 'jpeg', 'png'];
    if (in_array($extension, $imgExtArr)) {
      return true;
    }
    return false;
  }

  private function is_trailer($filename)
  {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $trailerExt = ['mp4'];
    if (in_array($extension, $trailerExt)) {
      return true;
    }
    return false;
  }

  protected function get($urlParams)
  {
    if (!isset($_SESSION['role']) or $_SESSION['role'] != 'admin') {
      // If not admin
      parent::redirect("/error", [], 401);
      return;
    }
    parent::render($urlParams, "create-film", "layouts/base");
  }

  protected function post($urlParams)
  {
    if (!isset($_SESSION['role']) or $_SESSION['role'] != 'admin') {
      parent::redirect("/error", 401);
      return;
    }
    try {

      // Get data
      $title = $_POST['title'];
      $released_year = $_POST['released-year'];
      $director = $_POST['director'];
      $description = $_POST['description'];
      $cast = $_POST['cast'];
      $genre = $_POST['genre'];

      // Check if file is valid
      if ($_FILES['image-path']['error'] == UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['image-path']['tmp_name'];
        $image_name = $_FILES['image-path']['name'];
        move_uploaded_file($image_tmp, __DIR__ . "/../../public/files/images/" . $image_name);
        $image_path = "/public/files/images/" . $image_name;

        if (!$this->is_image($image_name)) {
          throw new BadRequestException("Image file format is not valid");
        }
      } else {
        throw new BadRequestException("Image file is not valid");
      }
      if ($_FILES['trailer-path']['error'] == UPLOAD_ERR_OK) {
        $trailer_tmp = $_FILES['trailer-path']['tmp_name'];
        $trailer_name = $_FILES['trailer-path']['name'];
        move_uploaded_file($trailer_tmp, __DIR__ . "/../../public/files/trailers/" . $trailer_name);
        $trailer_path = "/public/files/trailers/" . $trailer_name;

        if (!$this->is_trailer($trailer_name)) {
          throw new BadRequestException("Trailer file format is not valid");
        }
      } else {
        throw new BadRequestException("Trailer Format is not valid");
      }

      // Call service
      $response = $this->service->add($image_path, $trailer_path, $title, $released_year, $director, $description, $cast, $genre);
      $msg = "Create film unsuccessful!";
      if ($response) {
        $msg = "Successfully created film!";
      }

      // Render response
      parent::render(["msg" => $msg], "home", "layouts/base");
    } catch (Exception $e) {
      $msg = $e->getMessage();
      parent::render(["errorMsg" => $msg], "create_film", "layouts/base");
    }
  }
}
