<?php

namespace App\Services;

use App\Models\Balance;

class BalanceService extends CrudService
{
    protected $modelClass = Balance::class;
}
