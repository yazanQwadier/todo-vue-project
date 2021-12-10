<?php
namespace App\services;

use App\repositories\CategoryRepository;

class CategoriesService {
    public $repository;

    public function __construct(){
        $this->repository = new CategoryRepository();
    }

    public function all(){
        echo $this->repository->all();
    }

}

?>