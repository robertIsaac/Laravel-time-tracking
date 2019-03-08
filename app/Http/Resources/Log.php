<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Log extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_name' => User::find($this->user_id)->name,
            'type' => $this->is_login ? 'login' : 'logout',
            'time' => $this->created_at,
        ];
    }
}
