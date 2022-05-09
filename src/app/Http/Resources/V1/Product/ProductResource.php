<?php

namespace App\Http\Resources\V1\Product;

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
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image,
            'price' => $this->price,
            'description' => $this->description,
            'created_at' => ['date_time' => $this->created_at->format('Y-m-d H:i:s'), 'ms' => strtotime($this->created_at->format('Y-m-d H:i:s')) * 1000],
        ];
    }
}
