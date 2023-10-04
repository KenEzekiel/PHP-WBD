<?php

namespace app\services;

use app\base\BaseService;
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
      ->set('genre', $genre);

    $id = $this->repository->insert($film, array(
      'image_path' => PDO::PARAM_STR,
      'trailer_path' => PDO::PARAM_STR,
      'title' => PDO::PARAM_STR,
      'released_year' => PDO::PARAM_INT,
      'director' => PDO::PARAM_STR,
      'trailer_path' => PDO::PARAM_STR,
      'description' => PDO::PARAM_STR,
      'cast' => PDO::PARAM_STR,
      'genre' => PDO::PARAM_STR,
    ));

    $response = $this->repository->getById($id);

    return $film->constructFromArray($response);
  }
}
