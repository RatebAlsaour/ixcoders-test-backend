<?php

namespace App\Http\Resources;

use App\Traits\ResourcesPagination;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    use ResourcesPagination;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'=>$this->title,
            'description'=>$this->description,
            'status'=>$this->status,
            'user'=>$this->user,
        ];
    }
}
