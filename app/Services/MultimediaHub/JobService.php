<?php

namespace App\Services\MultimediaHub;

use App\Helpers\PhotoUpload;
use App\Repositories\Shared\JobRepository;

class JobService
{
    public function __construct(private JobRepository $jobRebo) {}

    public function get()
    {
        return $this->jobRebo->getWithPaginate();
    }

    public function store($params)
    {
        if ($params['company_logo']) {
            $params['image_slug'] = $params['company_logo']->getClientOriginalName();
            $params['company_logo'] = PhotoUpload::upload($params['company_logo']);
        }
        return $this->jobRebo->store($params);
    }

    public function getById($id)
    {
        return $this->jobRebo->getById($id);
    }

    public function update($id, $params)
    {
        return $this->jobRebo->update($id, $params);
    }

    public function delete($id)
    {
        return $this->jobRebo->delete($id);
    }

    public function getMessage($type, $message)
    {
        return ['type' => $type, 'message' => $message];
    }

    public function ajaxResponse()
    {
    }
}
