<?php

namespace App\Repositories;

use App\Models\Shipping;

class ShippingRepository extends BaseRepository
{
    public function __construct(Shipping $model)
    {
        parent::__construct($model);
    }
}