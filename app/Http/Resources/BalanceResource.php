<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class BalanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'balance' => $this->balance,
            'user_id' => $this->user_id,
            'created_at' => (new Carbon($this->created_at))->format('Y-m-d H:i:s O'),
        ];
    }
}
