<?php

namespace app\controllers;

use app\base\BaseController;
use app\controllers\utils\response;
use app\Request;
use app\services\FilmService;
use app\services\ReviewService;
use app\services\UserService;

class FilmController extends BaseController
{
  public function __construct()
  {
    parent::__construct(FilmService::getInstance());
    $this->review_handler = ReviewService::getInstance();
    $this->user_handler = UserService::getInstance();
  }

  protected function get($urlParams)
  {
      $uri = Request::getURL();
      $page = (isset($_GET['page']) and (int) $_GET['page'] >= 1) ? $_GET['page'] : 1;
      $word = $_GET['q'] ?? "";
      $genre = $_GET['genre'] ?? 'all';
      $released_year = $_GET['year'] ?? 'all';
      $isDesc = $_GET['desc'] ?? false;
      $order = $_GET['order'] ?? 'title';
      $data = $this->service->searchAndFilter($word, $order, $isDesc, $genre, $released_year, $page);

      if ($uri == "/films")
      {
          $data['genres'] = $this->service->getAllCategoryValues('genre');
          $data['released_years'] = $this->service->getAllCategoryValues('released_year');

          parent::render($data, 'films', "layouts/base");
      }
      elseif($uri == '/film-details')
      {
          $data['film'] = $this->service->getById($_GET['film_id']);
          // $data['reviews'] = $this->service->getReviewsByFilmId($_GET['film_id']);
          $data['reviews'] = $this->review_handler->getByFilmId($_GET['film_id']);
          $commenting_user = [];
          foreach($data['reviews'] as $review)
          {
              $commenting_user[] = $this->user_handler->getById($review->get('user_id'));
          }
          $data['commenting_user'] = $commenting_user;
          parent::render($data, 'film-details', "layouts/base");
      }
      else
      {
          $films = [];

          foreach ($data['films'] as $film)
          {
              $films[] = $film->toResponse();
          }
          $data['films'] = $films;

          response::send_json_response($data);
      }
  }

}
