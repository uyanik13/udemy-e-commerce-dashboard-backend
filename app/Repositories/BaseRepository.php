<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;


abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(int $paginate = 10)
    {
        return $this->model->orderBy('id', 'desc')->paginate($paginate);
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {

        $record = $this->model->find($id);
        $record->update($data);
        return $record;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

}