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
            'issued_on' => $this->issued_on,
            'expires_on' => $this->expires_on,
            'has_expired' => $this->expires_on->isPast(),
            $this->mergeWhen($request->query->has('issuer'),
                [
                    'issuer' => isset($this->issuer) ? new CertificateResource($this->whenLoaded('issuer')) : $this->id,
                ]
            ),
            $this->mergeWhen($request->query->has('issued_certificates'),
                [
                    'issued_certificates' => isset($this->certificates) ? CertificateResource::collection($this->whenLoaded('certificates')) : [],
                ]
            ),
        ];
    }
}
