<?php

namespace App\Services\Shared;

use App\Helpers\PhotoUpload;
use App\Repositories\Shared\BlogRepository;
use App\Services\ServiceInterface;

class BlogService implements ServiceInterface
{
    public function __construct(private BlogRepository $blogRepo){}

    public function get($count, $filters = null)
    {
        return $this->blogRepo->getWithPaginate($count, $filters);
    }


    public function store($params)
    {
        if ($params['image']) {
            $params['image'] = $params['image']->getClientOriginalName();
            $params['image'] = PhotoUpload::upload($params['image']);
        }
        return $this->blogRepo->store($params);
    }

    public function getById($id)
    {
        return $this->blogRepo->getById($id);
    }


    public function update($id, $params)
    {
        return $this->blogRepo->update($id, $params);
    }


    public function delete($id)
    {
        return $this->blogRepo->delete($id);
    }
}
