<?php

namespace App\Services\Admin;

use App\Helpers\PhotoUpload;
use App\Models\Admin\Category;
use App\Repositories\Admin\CategoryRepository;
use App\Services\ServiceInterface;

class CategoryService implements ServiceInterface
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }


    public function get($count,$filters)
    {
        $count = (int) $count;
        return $this->categoryRepository->getWithPaginate($count,$filters);
    }

    public function getParentCategories()
    {
        return $this->categoryRepository->getParentCategoriesWithChildrenRelation();
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }


    public function store($params)
    {
        if($params['image'] && is_file($params['image'])){
            $params['slug'] = $params['image']->getClientOriginalName();
            $params['image'] = PhotoUpload::upload($params['image']);
        }
        return $this->categoryRepository->store($params);
    }


    public function getById($id)
    {
        return $this->categoryRepository->getById($id);
    }

    public function update($id, $params)
    {
        if($params['image'] && is_file($params['image'])){
            $params['slug'] = $params['image']->getClientOriginalName();
            $params['image'] = PhotoUpload::upload($params['image']);
        }
        return $this->categoryRepository->update($id, $params);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
