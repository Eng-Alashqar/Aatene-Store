<?php

namespace App\Repositories;


interface RepositoryInterface
{
    public function getWithPaginate($count,$filters);
    public function store($params);
    public function getById($id);
    public function update($id,$params);
    public function delete($id);
}
