<?php 

namespace app\models;
use app\base\BaseModel;

class ReviewModel extends BaseModel {
    public $user_id;
    public $film_id;
    public $rating;
    public $notes;
    public $published_time;

    public function __construct() {
        $this-> _primary_key = ['user_id', 'film_id'];
        return $this;
    }

    public function constructFromArray($array) {
        if (isset($array['user_id'], $array['film_id'], $array['rating'], $array['notes'], $array['published_time'])) {
            $this->user_id = $array['user_id'];
            $this->film_id = $array['film_id'];
            $this->rating = $array['rating'];
            $this->notes = $array['notes'];
            $this->published_time = $array['published_time'];
            return $this;
        }
    }

    public function toResponse() {
        return array(
            'user_id' => $this->user_id,
            'film_id' => $this->film_id,
            'rating' => $this->rating,
            'notes' => $this->notes,
            'published_time' => $this->published_time,
        );
    }
}