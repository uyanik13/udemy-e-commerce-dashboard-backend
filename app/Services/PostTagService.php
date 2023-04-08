<?php

namespace App\Services;

use App\Models\PostTag;
use App\Services\BaseService;

class PostTagService extends BaseService
{
    protected $repository;

    public function __construct(PostTag $repository)
    {
       $this->repository = $repository;
    }

    public function getAll()
    {
       return $this->repository->all();
    }

    public function find(int $id)
    {
       return $this->repository->find($id);
    }

    public function create(array $data)
    {
       return $this->repository->create($data);
    }
    
    public function update(int $id, array $data)
    {
       return $this->repository->update($id, $data);
    }

    public function delete(int $id)
    {
       return $this->repository->delete($id);
    }

}