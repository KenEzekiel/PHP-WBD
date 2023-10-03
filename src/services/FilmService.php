<?php

namespace app\services;

use app\base\BaseService;
use app\models\FilmModel;
use app\repositories\FilmRepository;

class FilmService extends BaseService
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
                FilmRepository::getInstance()
            );
        }
        return self::$instance;
    }

    public function searchAndFilter($word, $order, $isDesc, $genre, $released_year, $page = 1)
    {
        $data = null;
        $word = strtolower(trim($word));
        $response = $this->repository->getAllBySearchAndFilter($word, $order, $isDesc, $genre, $released_year , $page);
        $films = [];
        foreach ($response as $resp) {
            $film = new FilmModel();
            $films[] = $film->constructFromArray($resp);
        }
        $data['films'] = $films;

        $row_count = $this->repository->countRowBySearchAndFilter($word, $genre, $released_year);
        $total_page = ceil($row_count/PAGINATION_LIMIT);
        $data['total_page'] = $total_page;

        return $data;
    }

}
