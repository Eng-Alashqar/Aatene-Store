<?php

namespace App\Services\Store;

use App\Helpers\PhotoUpload;
use App\Models\Store\Category;
use App\Repositories\Admin\CategoryRepository;
use App\Services\ServiceInterface;

class CategoryService
{
    private $category;
    public function __construct()
    {
        $this->category = new Category;
    }


    public function get()
    {
        $filters = request()->query();
        $count = (int) request()->query('count') ;
        return $this->category->latest()->with(['parent','children','ancestors'])->filter($filters)->paginate($count == 0 ? 7 : $count);
    }

    public function getAllCategories()
    {
        return $this->category->latest()->with(['parent','children','ancestors'])->get();
    }

    public function getParentCategories()
    {
        return $this->category->latest()->whereNull('parent_id')->with(['children','ancestors'])->get();
    }

    public function store($params)
    {
        if($params['image'] && is_file($params['image'])){
            $params['slug'] = $params['image']->getClientOriginalName();
            $params['image'] = PhotoUpload::upload($params['image']);
        }
        $category =  $this->category->create($params);
        $category->storeImage($params['image'],$params['slug'],'photo');
        return $category;
    }


    public function getById($id)
    {
        return $this->category->findOrFail($id);
    }

    public function update($id, $params)
    {

        $category = $this->getById($id);
        if(array_key_exists('image',$params) && is_file($params['image'])){
            $params['slug'] = $params['image']->getClientOriginalName();
            $params['image'] = PhotoUpload::upload($params['image']);
            $category->storeImage($params['image'],$params['slug'],'photo');
        }
        return  $category->update($params);    }

    public function delete($id)
    {
        $category = $this->getById($id);
        return $category->delete();
    }
}
