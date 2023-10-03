<?php

namespace app\controllers;

use app\base\BaseController;
use app\Request;
use app\services\FilmService;

class FilmsController extends BaseController
{
  public function __construct()
  {
    parent::__construct(FilmService::getInstance());
  }

  protected function get($urlParams)
  {
      $uri = Request::getURL();
      if ($uri == "/films")
      {
          $data = $this->service->searchAndFilter("");
          // render view here
      }
      else
      {
          $word = $_GET['q'] ?? "";
          $genre = $_GET['genre'] ?? 'all';
          $released_year = $_GET['year'] ?? 'all';
          $isDesc = $_GET['desc'] ?? false;
          $order = $_GET['order'] ?? 'title';
          $page = (isset($_GET['page']) and (int) $_GET['page'] >= 1) ? $_GET['page'] : 1;

          $data = $this->service->searchAndFilter($word, $order, $isDesc, $genre, $released_year, $page);

          send_json_response($data);
      }
  }

}
