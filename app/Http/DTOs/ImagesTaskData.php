<?php

namespace App\Http\DTOs;

use App\Http\Services\FileService;

class ImagesTaskData extends BaseDTO
{
    public string $image;

    /**
     * @param mixed $object
     * @param ...$args you can use $this->getArgs($key, $args) function to get key value
     */
    public static function fromObject($object, ...$args): self
    {
        return new self([
            'image' => FileService::storeFiles(parent::getArg('image',$args),'image')['path'],
        ]);
    }
}
