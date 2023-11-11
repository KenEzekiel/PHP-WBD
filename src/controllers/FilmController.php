<?php

namespace app\controllers;

use app\base\BaseController;
use app\controllers\utils\response;
use app\Request;
use app\services\FavoriteService;
use app\services\FilmService;
use app\services\ReviewService;
use app\services\UserService;

class FilmController extends BaseController
{
    protected $review_handler;
    protected $user_handler;
    protected $favorite_handler;

    public function __construct()
    {
        parent::__construct(FilmService::getInstance());
        $this->review_handler = ReviewService::getInstance();
        $this->user_handler = UserService::getInstance();
        $this->favorite_handler = FavoriteService::getInstance();
    }

    protected function get($urlParams)
    {
        $uri = Request::getURL();
        $page = (isset($_GET['page']) and (int) $_GET['page'] >= 1) ? $_GET['page'] : 1;
        $word = $_GET['q'] ?? "";
        $genre = $_GET['genre'] ?? 'all';
        $released_year = $_GET['year'] ?? 'all';
        $isDesc = $_GET['sort'] ?? "asc";
        $order = $_GET['order'] ?? 'title';
        $data = $this->service->searchAndFilter($word, $order, $isDesc, $genre, $released_year, $page);
        $row_count = $this->service->countRowBySearchAndFilter($word, $genre, $released_year);

        if ($uri == "/films") {
            $data['genres'] = $this->service->getAllCategoryValues('genre');
            $data['released_years'] = $this->service->getAllCategoryValues('released_year');
            $data['total_page'] = ceil($row_count / 10);

            parent::render($data, 'films', "layouts/base");
        } elseif ($uri == '/film-details') {
            $data['film'] = $this->service->getById($_GET['film_id']);
            if (isset($_SESSION['user_id'])) {
                $data['isFavorite'] = $this->favorite_handler->isUserFavorite($_SESSION['user_id'], $_GET['film_id']);
            } else {
                $data['isFavorite'] = false;
            }

            parent::render($data, 'film-details', "layouts/base");
        } else {
            $films = [];

            foreach ($data['films'] as $film) {
                $films[] = $film->toResponse();
            }
            $data['films'] = $films;
            $data['total_page'] = ceil($row_count / 10);

            response::send_json_response($data);
        }
    }

    protected function post($urlParams)
    {
        if (!isset($_SESSION['user_id'])) {
            parent::redirect("/login");
        }
        $film_id = $urlParams['film_id'];
        if (isset($_POST['add_favorite'])) {
            $data['film'] = $this->service->getById($film_id);
            if ($_POST['add_favorite'] == 'yes') {
                $this->favorite_handler->addToFavorite($_SESSION['user_id'], $film_id);
                $data['isFavorite'] = true;
                parent::render($data, 'film-details', "layouts/base");
            } else {
                $this->favorite_handler->removeFromFavorite($_SESSION['user_id'], $film_id);
                $data['isFavorite'] = false;
                parent::render($data, 'film-details', "layouts/base");
            }
        }
    }
}
