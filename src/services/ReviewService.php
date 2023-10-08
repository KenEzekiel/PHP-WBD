<?php

namespace app\services;

use app\base\BaseService;
use app\exceptions\BadRequestException;
use app\models\ReviewModel;
use app\repositories\ReviewRepository;
use PDO;

class ReviewService extends BaseService
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
                ReviewRepository::getInstance()
            );
        }
        return self::$instance;
    }

    public function getReviewByUserFilmId($user_id, $film_id)
    {
        $response = $this->repository->getById($user_id, $film_id);
        $review = new ReviewModel();
        // var_dump($response);
        return $review->constructFromArray($response);
    }

    public function getAllReviewByFilmId($film_id)
    {
        $allReview = $this->repository->getByFilmId($film_id);
        // cek film_id nya harus sama
        $reviews = [];
        // var_dump($allReview);
        foreach ($allReview as $reviewData) {
            $review = new ReviewModel();
            $reviews[] = $review->constructFromArray($reviewData);
        }
        return $reviews;
    }

    public function create($user_id, $film_id, $rating, $notes, $published_time)
    {
        $review = new ReviewModel();
        $review->set('user_id', $user_id)->set('film_id', $film_id)->set('rating', $rating)->set('notes', $notes)->set('published_time', $published_time);

        $id = $this->repository->insert($review, array(
            'user_id' => PDO::PARAM_INT,
            'film_id' => PDO::PARAM_INT,
            'rating' => PDO::PARAM_INT,
            'notes' => PDO::PARAM_STR,
            'published_time' => PDO::PARAM_STR,
        ));

        $response = $this->repository->getById($user_id, $film_id);
        // $reviewArray = $review->constructFromArray($response);

        return $review->constructFromArray($response);
    }

    // Wrapper get by from repository
    public function getByRating($rating)
    {
        $review = new ReviewModel();
        $response = $this->repository->getByRating($rating);
        if ($response) {
            $review->constructFromArray($response);
        }
        return $review;
    }

    // Wrapper get by from repository
    public function getByPublishedTime($published_time)
    {
        $review = new ReviewModel();
        $response = $this->repository->getByPublishedTime($published_time);
        if ($response) {
            $review->constructFromArray($response);
        }
        return $review;
    }

    public function getByFilmId($film_id)
    {
        $allReview = $this->repository->getByFilmId($film_id);
        $reviews = [];
        foreach ($allReview as $reviewData) {
            $review = new ReviewModel();
            $reviews[] = $review->constructFromArray($reviewData);
        }
        return $reviews;
    }
}
