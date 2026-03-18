<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Vendor__ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $datetime = $this->created_at;
        $dt = Carbon::parse($datetime);
        $formatted = $dt->translatedFormat('M d, Y') . ' / ' . $dt->format('h:i') . ' صباحا';
        return [
            'id'=>$this->id,
            'user_phone_number' => $this->user?->phone_number,
            'rating' => $this->rating,
            'notes' =>$this->notes,
            'created_at' => $formatted
        ];
    }
}
