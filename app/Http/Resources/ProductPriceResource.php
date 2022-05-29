<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductPriceResource extends JsonResource
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
            'sentence_price' => $this->sentence_price,
            'price' => $this->price,
            'now_price' => $this->now_price,
            'old_price' => $this->old_price,
            'delivery_service' => $this->delivery_service,
        ];
    }
}
