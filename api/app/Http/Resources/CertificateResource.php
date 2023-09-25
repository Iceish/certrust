<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
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
            'type' => $this->type,
            'common_name' => $this->common_name,
            'organization' => $this->organization,
            'organization_unit' => $this->organization_unit,
            'country_name' => $this->country_name,
            'state_or_province_name' => $this->state_or_province_name,
            'locality_name' => $this->locality_name,
            'public_key' => $this->public_key,
            'private_key' => $this->private_key,
            'expires_on' => $this->expires_on,
            'issuer' => $this->issuer,
//            'issuer' => $this->whenLoaded('issuer'),

        ];
    }
}
