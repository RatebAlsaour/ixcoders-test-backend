<?php

namespace App\Traits;

trait HasDataTransferObjects
{
    /**
     * Retrieves and transforms the request data into an object.
     *
     * @param mixed $data The request instance or data array.
     * @param mixed $args
     * @return array The transformed data object.
     */
    public function getData($data, $args = null)
    {
        return $this->objectDataClass::fromObject((object) $data, $args)->all();
    }
}

