<?php

namespace App\Http\DTOs;

class TaskData extends BaseDTO
{
    public string $title;
    public string $description;
    public string $status;
    public int $user_id;


    /**
     * @param mixed $object
     * @param ...$args you can use $this->getArgs($key, $args) function to get key value
     */
    public static function fromObject($object, ...$args): self
    {

        return new self([
           'title' => $object->title,
            'description' => $object->description,
            'status' => $object->status,
            'user_id' => auth()->user()->id,
        ]);
    }
}
