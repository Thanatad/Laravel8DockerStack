<?php

namespace App\Http\Resources\V2\Product;

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
            'user' => UserResource::collection(collect()->push($this->whenLoaded('Users')))[0],
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image == null ? "https://picsum.photos/id/598/600/400" : $this->image,
            'price' => $this->price,
            'description' => $this->description,
            'created_at' => ['date_time' => $this->created_at->format('Y-m-d H:i:s'), 'ms' => strtotime($this->created_at->format('Y-m-d H:i:s')) * 1000],
        ];
    }
}
