<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Notificationresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'content' => $this->data,
            'read_at' =>$this->read_at,
            'status' =>$this->read_at != null ? 'read':'unread'
        ];
    }
}
