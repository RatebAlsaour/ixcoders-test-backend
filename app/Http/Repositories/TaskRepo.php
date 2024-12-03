<?php

namespace App\Http\Repositories;

use App\Models\Task;
use App\Interfaces\IHasSearchable;
use App\Interfaces\IHasFilterable;
use App\Interfaces\IHasOrderable;
use App\Interfaces\IHasDataTransferObjects;

class TaskRepo extends BaseRepo  implements IHasDataTransferObjects, IHasSearchable
{
    // public $filtersKeys = [];

     public $searchable = ['title', 'description'];

    // public $orderable = [];

    public function __construct()
    {
        parent::__construct(new Task());
    }
}
