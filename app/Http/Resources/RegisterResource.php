<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $token = $this->resource->createToken( 'access_token', ['*'], Carbon::now()->addHour( 24 ) )
            ->plainTextToken;

        return [
            'user_id' => $this->id,
            'email'    => $this->email,
            'token'   => $token,
        ];
    }
}
