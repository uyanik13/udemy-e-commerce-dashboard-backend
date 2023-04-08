<?php

namespace App\Services;

use Illuminate\Http\Request;

abstract class BaseService
{
   abstract public function getAll();
   abstract public function find(int $id);
   abstract public function create(Request $request);
   abstract public function update(int $id, Request $request);
   abstract public function delete(int $id);
}