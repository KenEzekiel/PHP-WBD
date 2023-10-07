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
        foreach ($reviews as $review) {
            $user_id = $review->user_id;
            $user = $this->userService->getById($user_id);
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
            if (isset($_POST['action'])) {
                $action = $_POST['action'];
                if ($action == 'edit') {
                    echo 'EDIT';
                    try {
                        $user_id = $_SESSION['user_id'];
                        $film_id = 1;
                        $review = $this->service->getReviewByUserFilmId($user_id, $film_id);
                        // GET DATA
                        $rating = $review->rating;
                        $notes = $review->notes;
                        $published_time = $review->published_time;

                        $review ->set('rating', $rating) ->set('notes', $notes)->set('published_time', $published_time);
                        $response = $this->service->update($review);
                        if ($response == 1) {
                            $msg = "Review updated successfully!";
                            $urlParams['msg'] = $msg;
                        }
                        parent::redirect('/film-detail', $urlParams);

                    } catch (Exception $e) {
                        $msg = $e->getMessage();
                        $urlParams['errorMsg'] = $msg;
                        parent::redirect("/review", $urlParams);
                    }
                } elseif ($action == 'delete') {
                    echo "DELETEE";
                    try {
                        $user_id = $_SESSION['user_id'];
                        $film_id = 1;
                        $notes = $this->service->getReviewByUserFilmId($user_id, $film_id);
                        $response = $this->service->deleteByUserFilmId($notes->user_id, $notes->film_id);
                        echo ($response);
                        if ($response == 1) {
                            $msg = "Review deleted successfully";
                            $urlParams['msg'] = $msg;
                        }
                        parent::redirect("/review", $urlParams);
                    } catch (Exception $e){
                        $msg = $e->getMessage();
                        $urlParams['errorMsg'] = $msg;
                        parent::redirect("/review", $urlParams);
                    }
                }
            } else {
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
        }
            parent::render($urlParams, 'film-detail', 'layouts/base');
        } else {
            // parent::render($urlParams, 'login', 'layouts/base');
            parent::redirect("/login");
        }
    }
}