<?php

namespace app\controllers;

use app\base\BaseController;
use app\exceptions\BadRequestException;
use app\models\FilmModel;
use app\Request;
use app\services\FilmService;
use Exception;

class UpdateFilmController extends BaseController
{
  protected $film;

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
      // TODO: make error controller
      parent::redirect("/error", 401);
      return;
    }

    $film_id = $urlParams['film-id'];
    $film = $this->service->getById($film_id);

    parent::render($film, "update_film", "layouts/base");
  }

  protected function post($urlParams)
  {
    if (!isset($_SESSION['role']) or $_SESSION['role'] != 'admin') {
      parent::redirect("/error", 401);
      return;
    }
    try {
      $film_id = $urlParams['film-id'];
      $film = $this->service->getById($film_id);

      // Get data
      $film['title'] = $_POST['title'];
      $film['released_year'] = $_POST['released-year'];
      $film['director'] = $_POST['director'];
      $film['description'] = $_POST['description'];
      $film['cast'] = $_POST['cast'];
      $film['genre'] = $_POST['genre'];

      // Check if file is valid
      if ($_FILES['image-path']['error'] == UPLOAD_ERR_NO_FILE) {
        $image_path = $film['image_path'];
      } else {
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
      }

      if ($_FILES['trailer-path']['error'] == UPLOAD_ERR_NO_FILE) {
        $trailer_path = $film['trailer_path'];
      } else {
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
      }

      // Call service
      $filmModel = new FilmModel();
      $filmModel->constructFromArray($film);
      $response = $this->service->update($filmModel);
      if ($response) {
        var_dump($response);
        $msg = "Successfully updated film!";
      }

      // Render response
      parent::render(["Msg" => $msg], "home", "layouts/base");
    } catch (Exception $e) {
      $msg = $e->getMessage();
      parent::render(["errorMsg" => $msg], "create_film", "layouts/base");
    }
  }
}
