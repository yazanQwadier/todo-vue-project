<?php
namespace App\services;

require './bootstrap.php';
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