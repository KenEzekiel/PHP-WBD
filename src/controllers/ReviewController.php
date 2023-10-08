<?php

namespace app\controllers;

use app\base\BaseController;
use app\exceptions\BadRequestException;
use app\Request;
use app\services\ReviewService;
use app\services\UserService;
use Exception;

class ReviewController extends BaseController
{
    protected $userService;

    public function __construct()
    {
        parent::__construct(ReviewService::getInstance());
        $this->userService = UserService::getInstance();
    }

    protected function get($urlParams)
    {
        $film_id = $urlParams['film_id'];
        $reviews = $this->service->getAllReviewByFilmId($film_id);
        foreach ($reviews as $review) {
            $user_id = $review->user_id;
            $user = $this->userService->getById($user_id);
            $review->username = $user->username;
        }
        $urlParams["reviews"] = $reviews;
        if (isset($_SESSION['user_id'])) {
            if (isset($urlParams['isset']) and $urlParams['isset'] == 'yes') {
                unset($urlParams['errorMsg']);
                $user_id = $_SESSION['user_id'];
                $user_review = $this->service->getReviewByUserFilmId($user_id, $film_id);
                if (isset($user_review->user_id, $user_review->film_id)) {
                    $urlParams["user_review"] = $user_review;
                }
            } else {
                if (isset($urlParams['isset']) and $urlParams['isset'] == 'no') {
                    $user_id = $_SESSION['user_id'];
                    $user_review = $this->service->getReviewByUserFilmId($user_id, $film_id);
                    if (isset($user_review)) {
                        $urlParams['rating'] = $user_review->rating;
                        $urlParams['notes'] = $review->notes;
                        $urlParams['published_time'] = $review->published_time;
                    }
                }
            }
            parent::render($urlParams, 'review', 'layouts/base');
        } else {
            parent::redirect("/login");
        }
    }

    protected function post($urlParams)
    {
        if (isset($_SESSION['user_id'])) {
            if (isset($_POST['action'])) {
                $action = $_POST['action'];
                if ($action == 'edit') {
                    try {
                        $data = [];
                        $data['film_id'] = $urlParams['film_id'];
                        $data['isset'] = 'no';
                        parent::redirect('/review', $data);
                    } catch (Exception $e) {
                        $msg = $e->getMessage();
                        $urlParams['errorMsg'] = $msg;
                        parent::redirect("/review", $urlParams);
                    }
                } elseif ($action == 'delete') {
                    try {
                        $user_id = $_SESSION['user_id'];
                        $film_id = $urlParams['film_id'];
                        $notes = $this->service->getReviewByUserFilmId($user_id, $film_id);
                        $response = $this->service->deleteByUserFilmId($notes->user_id, $notes->film_id);
                        if ($response == 1) {
                            $msg = "Review deleted successfully";
                            $urlParams['msg'] = $msg;
                            $urlParams['isset'] = 'no';
                        }
                        parent::redirect("/review", $urlParams);
                        // parent::render($urlParams, 'review', 'layouts/base');
                    } catch (Exception $e) {
                        $msg = $e->getMessage();
                        $urlParams['errorMsg'] = $msg;
                        parent::redirect("/review", $urlParams);
                    }
                }
            } else {
                try {
                    $user_id = $_SESSION['user_id'];
                    $film_id = $urlParams['film_id'];
                    $review = $this->service->getReviewByUserFilmId($user_id, $film_id);
                    if (!isset($_POST['notes']) or !isset($_POST['rating'])) {
                        throw new BadRequestException("Rating or notes can't be empty!");
                    }
                    if ($review == null) {
                        // No review, user review is empty
                        // GET DATA
                        $rating = $_POST['rating'];
                        $notes = $_POST['notes'];
                        date_default_timezone_set('Asia/Jakarta');
                        $published_time = date('Y-m-d H:i:s');
                        $response = $this->service->create($user_id, $film_id, $rating, $notes, $published_time);
                        unset($urlParams['msg']);
                        $urlParams['isset'] = 'yes';
                        unset($urlParams['errorMsg']);
                        parent::redirect('review', $urlParams);
                    } else {
                        // Has a review, want to update
                        // GET DATA
                        $rating = $_POST['rating'];
                        $notes = $_POST['notes'];
                        $published_time = $review->published_time;
                        $review->set('rating', $rating)->set('notes', $notes)->set('published_time', $published_time);
                        $response = $this->service->update($review);
                        if ($response == 1) {
                            $msg = "Review updated successfully!";
                            $urlParams['msg'] = $msg;
                        }
                        $urlParams['isset'] = 'yes';
                        unset($urlParams['errorMsg']);
                        parent::redirect('/review', $urlParams);
                    }
                } catch (Exception $e) {
                    $msg = $e->getMessage();
                    $urlParams['errorMsg'] = $msg;
                    parent::redirect("/review", $urlParams);
                }
            }
        } else {
            // parent::render($urlParams, 'login', 'layouts/base');
            parent::redirect("/login");
        }
    }
}
