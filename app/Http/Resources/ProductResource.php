<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $test = new  \App\Helpers\Test();
        $result = [];
        //    dd($this->rattingProdut);
        foreach ($this->rattingProdut as $data) {

            $result[] = $data->evaluation;
        }
        $ratting = $test->getRatings($result);



        return [
            'id' => $this->id,
            'name' => $this->name(),
            'product_number' => $this->product_number,
            'discription' => $this->discription(),
            'country' => $this->country,
            'prices' => new ProductPriceResource($this->prices()->first()),
            'image' => asset('assets/' . $this->image),
            'type' => $this->type,
            'vendor_name' => $this->vendor_name,
            'url' => $this->url,
            'colors' => $this->details,
            'phone' => $this->phone,
            'rating' =>  $ratting,
            'whatsapp' => $this->whatsapp,

        ];
    }
}
