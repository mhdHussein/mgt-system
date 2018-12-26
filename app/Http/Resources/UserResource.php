<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'name' => $this->name,
          'is_active' => !! $this->is_active,
          'email' => $this->email,
          'department' => $this->department->name,  
          'warehouse' => $this->warehouse['name'],
          'role' => $this->role->name  
        ];
    }
}
