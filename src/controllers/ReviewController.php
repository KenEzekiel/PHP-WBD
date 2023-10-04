<?php 

namespace app\controllers;

use app\base\BaseController;
use app\Request;
use app\services\ReviewService;
use Exception;

class ReviewController extends BaseController {
    public function __construct() {
        parent::__construct(ReviewService::getInstance());
    }

    protected function get($urlParams) {
        if (isset($_SESSION['user_id'])) {
            try {
                $user_id = $_SESSION['user_id'];
                // $film_id = $urlParams['film_id']
                $film_id = 1;
                $reviews = $this->service->getAllReviewByFilmId($film_id);
                // var_dump($reviews);
                $urlParams["reviews"] = $reviews;
                // $user = $this->service->getById($user_id);
                // $username = $user->$username;
                // $urlParams["username"] = $username;
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
                // $user_id = $_SESSION['user_id'];
                // $film_id = $urlParams['film_id'];
                $user_id = 3;
                $film_id = 1;
                $rating = $_POST['rating'];
                $notes = $_POST['notes'];
                date_default_timezone_set('Asia/Jakarta');
                $published_time = date('Y-m-d H:i:s');
                $response = $this->service->create($user_id, $film_id, $rating, $notes, $published_time);
                var_dump($response);
            } catch (Exception $e) {
                $msg = $e->getMessage();
                parent::render(['errorMsg' => $msg], 'film-detail', 'layouts/base');
            }
        } else {
            parent::render($urlParams, 'login', 'layouts/base');
            // parent::redirect("/login");
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