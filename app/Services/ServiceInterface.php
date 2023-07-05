<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

interface ServiceInterface
{
    public function get($count,$filters);
    public function store($params);
    public function getById($id);
    public function update($id,$params);
    public function delete($id);

}
