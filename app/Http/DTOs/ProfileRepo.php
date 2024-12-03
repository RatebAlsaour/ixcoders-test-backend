<?php

namespace App\Http\DTOs;

class ProfileRepo extends BaseDTO
{
    public ?int $id = null;

    /**
     * @param mixed $object
     * @param ...$args you can use $this->getArgs($key, $args) function to get key value
     */
    public static function fromObject($object, ...$args): self
    {
        return new self([

        ]);
    }
}
