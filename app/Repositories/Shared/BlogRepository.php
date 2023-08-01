<?php

namespace App\Repositories\Shared;

use App\Models\Store\Blog;
use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

class BlogRepository implements RepositoryInterface
{

    public function __construct(private Blog $blog){}

    public function getWithPaginate($count = 7,$filters = null)
    {
        return $this->blog->latest()->paginate((int) $count);
    }

    public function store($params)
    {
        $blog =  $this->blog->create($params);
        $blog->storeImage($params['image'],$params['image_slug'],'image');
        return $blog;
    }

    public function getById($id)
    {
        return $this->blog->findOrFail($id);
    }

    public function update($id, $params)
    {
        $blog = $this->getById($id);
        return  $blog->update([$params]);
    }

    public function delete($id)
    {
        $blog = $this->getById($id);
        return $blog->delete();
    }
}

