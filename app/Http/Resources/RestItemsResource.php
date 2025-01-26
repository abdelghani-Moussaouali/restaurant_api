<?php

namespace App\Http\Resources;

use App\Models\menu;
use App\Models\User;
use Illuminate\Http\Request;


use Illuminate\Http\Resources\Json\JsonResource;

class RestItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'customers_id' => $this->customers_id,
            'email' => $this->company_email,
            'phone_number' => $this->phone_number,
            'category' => $this->category,
            'wilaya' => $this->wilaya,
            'address' => $this->address,
            'image' => ImageResouece::collection($this->images),
            'menu' =>  MenuResource::collection($this->menu),
            'reviews' =>   ReviewResource::collection($this->review),
            'customer' => new customerResource($this->customers),
        ];
    }
}
