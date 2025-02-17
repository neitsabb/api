<?php

namespace App\Http\Resources;

use App\Enums\OrderStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'customer_name' => $this->customer,
            'guests' => $this->guests,
            'status' => OrderStatusEnum::labels($this->status),
            'products' => ProductResource::make($this->whenLoaded('products')),
            'created_by' => '1',
            'created_at' => $this->date
        ];
    }
}
