<?php

namespace App\Http\Resources\V2\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'fullname' => $this->fullname,
            'avatar' => $this->avatar == null ? "https://picsum.photos/id/598/600/400" : $this->avatar,
            'tel' => $this->tel
        ];
    }
}
