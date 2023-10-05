<?php 

namespace app\controllers;

use app\base\BaseController;
use app\Request;
use app\services\ReviewService;
use app\services\UserService;
use Exception;

class ReviewController extends BaseController {
    protected $userService;

    public function __construct() {
        parent::__construct(ReviewService::getInstance());
        $this->userService = UserService::getInstance();
    }

    protected function get($urlParams) {
        $film_id = 1;
        $reviews = $this->service->getAllReviewByFilmId($film_id);
        // Saya mau dari reviews ditambah attribut username untuk masing-masing user_id 
        // dengan memanggil $userService->get
        // $users = $userService->getById($reviews->'user_id');
        // $username = $users->username;
        // Pasangkan username dengan user_id yang sesuai & isi ke reviews
        // Sehingga nanti saat di passing di urlParams, reviews memiliki data username
        foreach ($reviews as $review) {
            $user_id = $review->user_id;
            $user = $this->userService->getById($user_id);
            // echo '<pre>';
            // var_dump($user->username);
            // echo '<pre>';
            $review->username = $user->username;
        }
        $urlParams["reviews"] = $reviews;
        if (isset($_SESSION['user_id'])) {
            try {
                $user_id = $_SESSION['user_id'];
                $user_review = $this->service->getReviewByUserFilmId($user_id, $film_id);
                $urlParams["user_review"] = $user_review;
            } catch (Exception $e) {
                echo $e;
            }
        }
        parent::render($urlParams, 'film-detail', 'layouts/base');
    }

    protected function post($urlParams) {
        if (isset($_SESSION['user_id'])) {
            try {
                // GET DATA
                $user_id = $_SESSION['user_id'];
                // $film_id = $urlParams['film_id'];
                $film_id = 1;
                $rating = $_POST['rating'];
                $notes = $_POST['notes'];
                date_default_timezone_set('Asia/Jakarta');
                $published_time = date('Y-m-d H:i:s');
                $response = $this->service->create($user_id, $film_id, $rating, $notes, $published_time);
            } catch (Exception $e) {
                $msg = $e->getMessage();
                parent::render(['errorMsg' => $msg], 'film-detail', 'layouts/base');
            }
            parent::render($urlParams, 'film-detail', 'layouts/base');
        } else {
            parent::render($urlParams, 'login', 'layouts/base');
        }
    }

    protected function put($urlParams) {
        try {
            parent::put($urlParams);
        } catch (Exception $e) {
            echo $e;
        }
    }

    protected function delete($urlParams) {
        try {
            parent::delete($urlParams);
        } catch (Exception $e) {
            echo $e;
        }
    }
}