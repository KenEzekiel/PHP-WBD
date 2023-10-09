<?php

namespace app\services;

use app\base\BaseService;
use app\controllers\FilmController;
use app\exceptions\BadRequestException;
use app\models\FavoriteModel;
use app\models\ReviewModel;
use app\repositories\FavoriteRepository;
use app\repositories\ReviewRepository;
use PDO;

class FavoriteService extends BaseService {
    protected static $instance;
    protected $userRepository;

    private function __construct($repository) {
        parent::__construct();
        $this->repository = $repository;
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                FavoriteRepository::getInstance()
            );
        }
        return self::$instance;
    }

    public function getUserFavoriteFilms($user_id) {
        return $this->repository->getUserFavorites($user_id);
    }

    public function addToFavorite($user_id, $film_id) {
        $favorite = new FavoriteModel();
        $favorite->set('user_id', $user_id)->set('film_id', $film_id);
        return $this->repository->insertFavorite($favorite);
    }

    public  function removeFromFavorite($user_id, $film_id) {
        $favorite = new FavoriteModel();
        $favorite->set('user_id', $user_id)->set('film_id', $film_id);
        return $this->repository->deleteFavorite($favorite);
    }

    public function isUserFavorite($user_id, $film_id) {
        $favorite = $this->repository->getById($user_id, $film_id);
        if (count($favorite) == 0) {
            return false;
        }
        return true;
    }

}