<?php

namespace App\Requests\Authority;

use Illuminate\Foundation\Http\FormRequest;

class CreateAuthorityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'common_name' => 'required|string',
            'organization' => 'required|string',
            'organization_unit' => 'required|string',
            'country_name' => 'required|string',
            'state_or_province_name' => 'required|string',
            'locality_name' => 'required|string',
            'validity_days' => 'required|numeric',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
