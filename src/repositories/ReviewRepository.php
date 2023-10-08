<?php

namespace app\repositories;

use app\base\BaseRepository;
use app\models\ReviewModel;
use PDO;

class ReviewRepository extends BaseRepository
{
    protected static $instance;
    protected $tableName = 'review';

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

    public function getById($user_id, $film_id)
    {
        return $this->findOne(['user_id' => [$user_id, PDO::PARAM_INT], 'film_id' => [$film_id, PDO::PARAM_INT]]);
    }

    public function getByFilmId($film_id)
    {
        return $this->findAll(['film_id' => [$film_id, PDO::PARAM_INT]], null, null, null, false);
    }

    public function getByRating($rating)
    {
        return $this->findAll(['rating' => [$rating, PDO::PARAM_INT]], null, null, null, false);
        // return $this->findOne(['rating' => [$rating, PDO::PARAM_INT]]);        
    }

    public function getByPublishedTime($published_time)
    {
        return $this->findAll(['published_time' => [$published_time, PDO::PARAM_STR]], null, null, null, false);
    }

    public function deleteByUserFilmId($user_id, $film_id)
    {
        $review = $this->getById($user_id, $film_id);
        $reviewModel = new ReviewModel();
        $reviewModel->constructFromArray($review);
        // var_dump($reviewModel);
        return $this->delete($reviewModel);
    }
}
