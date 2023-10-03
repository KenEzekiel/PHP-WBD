<?php

namespace app\models;

use app\base\BaseModel;

class FilmModel extends BaseModel
{
  public $film_id;
  public $image_path;
  public $trailer_path;
  public $title;
  public $released_year;
  public $director;
  public $description;
  public $cast;
  public $genre;

  public function __construct()
  {
    $this->_primary_key = 'film_id';
    return $this;
  }

  public function constructFromArray($array)
  {
    $this->film_id = $array['film_id'];
    $this->image_path = $array['image_path'];
    $this->trailer_path = $array['trailer_path'];
    $this->title = $array['title'];
    $this->released_year = $array['released_year'];
    $this->director = $array['director'];
    $this->description = $array['description'];
    $this->cast = $array['cast'];
    $this->genre = $array['genre'];
    return $this;
  }

  public function toResponse()
  {
    return array(
        'film_id' => $this->film_id,
        'image_path' => $this->image_path,
        'trailer_path' => $this->trailer_path,
        'title' => $this->title,
        'released_year' => $this->released_year,
        'director' => $this->director,
        'description' => $this->description,
        'cast' => $this->cast,
        'genre' => $this->genre,
    );
  }
}
