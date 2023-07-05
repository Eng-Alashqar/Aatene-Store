<?php

namespace App\Repositories\Shared;

interface PanelRepository
{
    public function getWithPaginate($count = 7);

    public function store($params);

    public function getById($id);

    public function update($id, $params);

    public function delete($id);
}
