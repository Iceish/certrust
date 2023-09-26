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
        $request->include = $request->include ?? "";
        $include = explode( ',', $request->include);

        return [
            'id' => $this->whenNotNull($this->id),
            'type' => $this->whenNotNull($this->type),
            'common_name' => $this->whenNotNull($this->common_name),
            'organization' => $this->whenNotNull($this->organization),
            'organization_unit' =>$this->whenNotNull($this->organization_unit),
            'country_name' => $this->whenNotNull($this->country_name),
            'state_or_province_name' => $this->whenNotNull($this->state_or_province_name),
            'locality_name' => $this->whenNotNull($this->locality_name),
            'issued_on' => $this->whenNotNull($this->issued_on),
            'expires_on' => $this->whenNotNull($this->expires_on),
            'has_expired' => $this->whenNotNull($this->expires_on?->isPast()),
            'issuer' => $this->when(in_array('issuer', $include),CertificateResource::make($this->whenLoaded('issuer'))),
            'certificates' => $this->when(in_array('certificates', $include),CertificateResource::collection($this->whenLoaded('certificates'))),
        ];
    }
}
