<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Interfaces\IHasSearchable;
use App\Interfaces\IHasFilterable;
use App\Interfaces\IHasOrderable;
use App\Interfaces\IHasDataTransferObjects;

class UserRepo extends BaseRepo implements IHasDataTransferObjects, IHasSearchable
{
    // public $filtersKeys = [];

     public $searchable = ['first_name','last_name','email'];

    // public $orderable = [];

    public function __construct()
    {
        parent::__construct(new User());
    }
}
