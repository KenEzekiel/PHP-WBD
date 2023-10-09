<?php 

namespace app\models;
use app\base\BaseModel;

class FavoriteModel extends BaseModel {
    public $user_id;
    public $film_id;

    public function __construct() {
        $this-> _primary_key = ['user_id', 'film_id'];
        return $this;
    }

    public function constructFromArray($array) {
        $this->user_id = $array['user_id'];
        $this->film_id = $array['film_id'];
        return $this;
    }

    public function toResponse() {
        return array(
            'user_id' => $this->user_id,
            'film_id' => $this->film_id,
        );
    }
}