<?php

namespace app\services;

use app\base\BaseService;
use app\exceptions\BadRequestException;
use app\models\FilmModel;
use app\repositories\FilmRepository;
use PDO;

class FilmService extends BaseService
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
        FilmRepository::getInstance()
      );
    }
    return self::$instance;
  }

  public function add($image_path, $trailer_path, $title, $released_year, $director, $description, $cast, $genre)
  {
    $currentDateTime = new \DateTime('now', new \DateTimeZone('UTC'));
    $formattedDateTime = $currentDateTime->format("Y-m-d H:i:s"); 
    $film = new FilmModel();
    $film
      ->set('image_path', $image_path)
      ->set('trailer_path', $trailer_path)
      ->set('title', $title)
      ->set('released_year', $released_year)
      ->set('director', $director)
      ->set('trailer_path', $trailer_path)
      ->set('description', $description)
      ->set('cast', $cast)
      ->set('genre', $genre)
      ->set('last_updated', $formattedDateTime);

    $id = $this->repository->insert($film, array(
      'image_path' => PDO::PARAM_STR,
      'trailer_path' => PDO::PARAM_STR,
      'title' => PDO::PARAM_STR,
      'released_year' => PDO::PARAM_INT,
      'director' => PDO::PARAM_STR,
      'description' => PDO::PARAM_STR,
      'cast' => PDO::PARAM_STR,
      'genre' => PDO::PARAM_STR,
      'last_updated'=> PDO::PARAM_STR,
    ));

    $response = $this->repository->getById($id);

    return $film->constructFromArray($response);
  }

  public function getById($film_id)
  {
    $film = $this->repository->getById($film_id);

    if ($film) {
      $filmModel = new filmModel();
      $filmModel->constructFromArray($film);
      return $filmModel;
    }

    return null;
  }

  public function getImagePath($film_id)
  {
    if (!$film_id) {
      throw new BadRequestException("INVALID_ID");
    }
    $film = $this->repository->getById($film_id);

    if ($film) {
      return "public/" . $film["image_path"]; 
    }

    throw new BadRequestException("IMAGE_NOT_FOUND");
  }

  public function update($film)
  {
    $arrParams = [];
    $arrParams['image_path'] = PDO::PARAM_STR;
    $arrParams['trailer_path'] = PDO::PARAM_STR;
    $arrParams['title'] = PDO::PARAM_STR;
    $arrParams['released_year'] = PDO::PARAM_INT;
    $arrParams['director'] = PDO::PARAM_STR;
    $arrParams['description'] = PDO::PARAM_STR;
    $arrParams['cast'] = PDO::PARAM_STR;
    $arrParams['genre'] = PDO::PARAM_STR;
    $arrParams['last_updated'] = PDO::PARAM_STR;

    return $this->repository->update($film, $arrParams);
  }


  public function searchAndFilter($word, $order, $isDesc, $genre, $released_year, $page = 1)
  {
    $data = null;
    $word = strtolower(trim($word));
    $response = $this->repository->getAllBySearchAndFilter($word, $order, $isDesc, $genre, $released_year, $page);
    $films = [];
    foreach ($response as $resp) {
      $film = new FilmModel();
      $films[] = $film->constructFromArray($resp);
    }
    $data['films'] = $films;

    $row_count = $this->repository->countRowBySearchAndFilter($word, $genre, $released_year);
    $total_page = ceil($row_count / 10);
    $data['total_page'] = $total_page;

    return $data;
  }

  public function polling($isInitialSync)
  {
    $response = $this->repository->getAllBySearchAndFilter(null, null, null, null, null, null, null, $isInitialSync);
    $films = [];
    foreach ($response as $resp) {
      $film = new FilmModel();
      $films[] = $film->constructFromArray($resp);
    }
    return $films;
  }

  public function getAllCategoryValues($category)
  {
    return $this->repository->getAllCategoryValues($category);
  }

  public function deleteById($film_id)
  {
    return $this->repository->deleteById($film_id);
  }

  public function countRowBySearchAndFilter($word, $genre = 'all', $released_year = 'all')
  {
      return $this->repository->countRowBySearchAndFilter($word, $genre, $released_year);
  }

}
