<?php

namespace app\services;

use app\base\BaseService;
use app\controllers\FilmController;
use app\exceptions\BadRequestException;
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

}