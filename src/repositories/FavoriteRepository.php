<?php

namespace app\repositories;

use app\base\BaseRepository;
use PDO;

class FavoriteRepository extends BaseRepository {
    protected static $instance;
    protected $tableName = 'favorite';

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function getUserFavorites($user_id) {
        return $this->findAll(['user_id' => [$user_id, PDO::PARAM_INT]]);
    }

}