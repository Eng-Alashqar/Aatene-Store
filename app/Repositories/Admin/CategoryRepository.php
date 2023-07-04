<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Category;

class CategoryRepository
{

    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategoriesWithPaginate($count = 7,$filters = null)
    {
        return $this->category->latest()->with(['parent','children','ancestors'])->filter($filters)->paginate($count);
    }

    public function getParentCategoriesWithChildrenRelation()
    {
        return $this->category->latest()->whereNull('parent_id')->with(['children'])->get();
    }

    public function store($params)
    {
        $category =  $this->category->create($params);
        $category->storeImage($params['image'],$params['slug'],'photo');
        return $category;

    }

    public function getById($id)
    {
        return $this->category->find($id);
    }

    public function update($id, $params)
    {
        $category = $this->getById($id);
        $category->storeImage($params['image'],$params['slug'],'photo');
        return  $category->update($params);
    }


    public function delete($id)
    {
        $category = $this->getById($id);
        return $category->delete();
    }
}
