<?php

namespace app\repositories;

use app\base\BaseRepository;
use app\models\FilmModel;
use PDO;

class FilmRepository extends BaseRepository
{
  protected static $instance;
  protected $tableName = 'film';

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

  public function getById($film_id)
  {
    return $this->findOne(['film_id' => [$film_id, PDO::PARAM_INT]]);
  }

  public function getAllBySearchAndFilter(
    $word,
    $order = 'title',
    $isDesc = "asc",
    $genre = 'all',
    $released_year = 'all',
    $pageNo = 1,
    $limit = 10
  ) {
    $where = [];

    if (isset($genre) and !empty($genre) and $genre != 'all') {
      $where['genre'] = [$genre, PDO::PARAM_STR, 'LIKE'];
    }
    if (isset($released_year) and !empty($released_year) and $released_year != 'all') {
      $where['released_year'] = [$released_year, PDO::PARAM_INT];
    }
    if (isset($word) and !empty($word)) {
      $where['title'] = [$genre, PDO::PARAM_STR, 'LIKE', ['director']];
    }

    return $this->findAll($where, $order, $pageNo, $limit, $isDesc);
  }

  public function countRowBySearchAndFilter($word, $genre = 'all', $released_year = 'all')
  {
    $where = [];

    if (isset($genre) and !empty($genre) and $genre != 'all') {
      $where['genre'] = [$genre, PDO::PARAM_STR, 'LIKE'];
    }
    if (isset($released_year) and !empty($released_year) and $released_year != 'all') {
      $where['released_year'] = [$released_year, PDO::PARAM_INT];
    }
    if (isset($word) and !empty($word)) {
      $where['title'] = [$genre, PDO::PARAM_STR, 'LIKE', ['director']];
    }

    return $this->countRow($where);
  }

  public function getAllCategoryValues($category)
  {
    return $this->getDistinctValues($category);
  }

  public function deleteById($film_id)
  {
    $film = $this->getById($film_id);
    $filmModel = new FilmModel();
    $filmModel->constructFromArray($film);
    return $this->delete($filmModel);
  }
}
