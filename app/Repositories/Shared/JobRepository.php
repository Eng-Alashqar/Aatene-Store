<?php

namespace App\Repositories\Shared;

use App\Models\MultimediaHub\Job;

class JobRepository implements PanelRepository
{
    public function __construct(private Job $job)
    {
    }

    public function getWithPaginate($count = 7)
    {
        return $this->job->paginate($count);
    }

    public function store($params)
    {
        $job = $this->job->create($params);
        return $job;
    }

    public function getById($id)
    {
        return $this->job->findOrFail($id);
    }

    public function update($id, $params)
    {
        $job = $this->getById($id);
        $job->update((array)$params);

        return $job;
    }

    public function delete($id)
    {
        $job = $this->getById($id)->delete();
        return $job;
    }
}
