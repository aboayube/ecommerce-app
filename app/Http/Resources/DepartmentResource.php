<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name(),
            'name_en' => $this->name_en,
            'status' => $this->status == 0 ? 'غير مفعل' : 'مفعل',

            'user' => new UserResource($this->user),
            'products' =>   ProductResource::collection($this->product),
        ];
    }
}
