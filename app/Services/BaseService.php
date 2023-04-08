<?php

namespace App\Services;

abstract class BaseService
{
   abstract public function getAll();
   abstract public function find(int $id);
   abstract public function create(array $data);
   abstract public function update(int $id, array $data);
   abstract public function delete(int $id);
}