<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    //  protected $lang;
    // public function __construct($resource, $lang)
    // {
    //     parent::__construct($resource);
    //     $this->lang = $lang;
    // }
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' =>$this->name,
            'code' =>$this->code
        ];
    }
}
