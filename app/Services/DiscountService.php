<?php

namespace App\Services;

use App\Repositories\DiscountRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class DiscountService extends BaseService
{
    protected $repository;

    public function __construct(DiscountRepository $repository)
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

    public function create(Request $request)
    {
       return $this->repository->create($request->all());
    }
    
    public function update(int $id, Request $request)
    {
       return $this->repository->update($id, $$request->all());
    }

    public function delete(int $id)
    {
       return $this->repository->delete($id);
    }

}