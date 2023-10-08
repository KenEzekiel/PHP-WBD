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
      // If not admin
      parent::redirect("/error", [], 401);
      return;
    }

    if (!isset($urlParams['film_id'])) {
      // If there is no film_id parameter
      parent::redirect("/");
    }
    $film_id = $urlParams['film_id'];
    $film = $this->service->getById($film_id);
    if (!$film) {
      // If no film
      parent::redirect("/");
    }
    // Get all data
    $data = [];
    $data['film_id'] = $film_id;
    $data['title'] = $film->title;
    $data['released_year'] = $film->released_year;
    $data['director'] = $film->director;
    $data['description'] = $film->description;
    $data['cast'] = $film->cast;
    $data['genre'] = $film->genre;

    if (isset($urlParams['action'])) {
      // Deletion
      $data['action'] = $urlParams['action'];
      parent::render($data, 'delete-film', 'layouts/base');
    } else {
      // Update
      parent::render($data, "update-film", "layouts/base");
    }
  }

  protected function post($urlParams)
  {
    if (!isset($_SESSION['role']) or $_SESSION['role'] != 'admin') {
      // If not admin
      parent::redirect("/error", [], 401);
      return;
    }
    try {
      $film_id = $urlParams['film_id'];
      $film = $this->service->getById($film_id);

      // Delete or update
      if (isset($_POST['delete_confirm'])) {
        // Delete page
        if ($_POST['delete_confirm'] == 'yes') {
          // Confirm deletion
          $response = $this->service->deleteById($film->film_id);
          if ($response == 1) {
            $msg = "film $film->title deleted successfully";
          }
          // Unset the parameters
          unset($urlParams['action']);
          unset($urlParams['film_id']);
          unset($urlParams['delete_confirm']);
          // Redirect back to home or films page
          parent::redirect("/", ["Msg" => $msg]);
        } else {
          unset($urlParams['action']);
          unset($urlParams['delete_confirm']);
          unset($urlParams['title']);
          // Redirect to own link
          parent::redirect("/update-film", $urlParams);
        }
      } else if (isset($_POST['action'])) {
        // Delete button clicked
        parent::redirect("/update-film", ['action' => $_POST['action'], 'film_id' => $film_id, 'title' => $film->title]);
      } else {
        // Update
        // Get data
        $data = [];
        $data['film_id'] = $film->film_id;
        $data['title'] = $_POST['title'];
        $data['released_year'] = $_POST['released-year'];
        $data['director'] = $_POST['director'];
        $data['description'] = $_POST['description'];
        $data['cast'] = $_POST['cast'];
        $data['genre'] = $_POST['genre'];
        // Check if file is valid
        if ($_FILES['image-path']['error'] == UPLOAD_ERR_NO_FILE) {
          // No file uploaded, use current
          $data['image_path'] = $film->image_path;
        } else {
          if ($_FILES['image-path']['error'] == UPLOAD_ERR_OK) {
            // Use uploaded file
            $image_tmp = $_FILES['image-path']['tmp_name'];
            $image_name = $_FILES['image-path']['name'];
            move_uploaded_file($image_tmp, __DIR__ . "/../../public/files/img/" . $image_name);
            $image_path = "/public/files/img/" . $image_name;
            $data['image_path'] = $image_path;

            if (!$this->is_image($image_name)) {
              throw new BadRequestException("Image file format is not valid");
            }
          } else {
            throw new BadRequestException("Image file is not valid");
          }
        }

        if ($_FILES['trailer-path']['error'] == UPLOAD_ERR_NO_FILE) {
          // No file uploaded, use current
          $data['trailer_path'] = $film->trailer_path;
        } else {
          if ($_FILES['trailer-path']['error'] == UPLOAD_ERR_OK) {
            // Use uploaded file
            $trailer_tmp = $_FILES['trailer-path']['tmp_name'];
            $trailer_name = $_FILES['trailer-path']['name'];
            move_uploaded_file($trailer_tmp, __DIR__ . "/../../public/files/trailers/" . $trailer_name);
            $trailer_path = "/public/files/trailers/" . $trailer_name;
            $data['trailer_path'] = $trailer_path;

            if (!$this->is_trailer($trailer_name)) {
              throw new BadRequestException("Trailer file format is not valid");
            }
          } else {
            throw new BadRequestException("Trailer Format is not valid");
          }
        }

        // Call service
        $filmModel = new FilmModel();
        $filmModel->constructFromArray($data);
        $response = $this->service->update($filmModel);
        $msg = "Update unsuccessful!";
        if ($response) {
          $msg = "Successfully updated film!";
        }
        // Render response
        parent::redirect("/", ["msg" => $msg]);
      }
    } catch (Exception $e) {
      $msg = $e->getMessage();
      $data['errorMsg'] = $msg;
      parent::render($data, "update-film", "layouts/base");
    }
  }
}
