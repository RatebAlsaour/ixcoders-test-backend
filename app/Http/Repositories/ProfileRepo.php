<?php

namespace App\Http\Repositories;

use App\Models\Profile;
use App\Interfaces\IHasSearchable;
use App\Interfaces\IHasFilterable;
use App\Interfaces\IHasOrderable;
use App\Interfaces\IHasDataTransferObjects;

class ProfileRepo extends BaseRepo
{
    // public $filtersKeys = [];

    // public $searchable = [];

    // public $orderable = [];

    public function __construct()
    {
        parent::__construct(new Profile());
    }
}
