<?php

namespace App\Http\DTOs;

class UserData extends BaseDTO
{
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $email;
    public ?string $password = null;
    public ?string $phone = null;
    public ?string $status = null;
    public ?string $role = null;

    /**
     * @param mixed $object
     * @param ...$args you can use $this->getArgs($key, $args) function to get key value
     */
    public static function fromObject($object, ...$args): self
    {
        return new self([
            'first_name' => $object->first_name,
            'last_name' => $object->last_name,
            'email' => $object->email,
            'password' => $object->password,
            'phone' => $object->phone,
            'role' => $object->role,
            'status' => $object->status,
        ]);
    }
}
