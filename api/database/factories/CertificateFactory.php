<?php

namespace Database\Factories;

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    protected $model = Certificate::class;

    public function definition(): array
    {
        $issued_on =
            $this->faker->dateTimeInInterval('now', '-10 years');
        $expires_on =
            rand(0, 10) ?
                $this->faker->dateTimeInInterval($issued_on->format('Y-m-d H:i:s').' +1 day','+ 10 year')
                :
                $this->faker->dateTimeInInterval('now','+ ' . rand(2,25) . ' days');

        return [
            'type' => -1,
            'common_name' => $this->faker->domainName,
            'organization' => $this->faker->company,
            'organization_unit' => $this->faker->companySuffix,
            'country_name' => $this->faker->countryCode,
            'state_or_province_name' => $this->faker->state,
            'locality_name' => $this->faker->city,
            'public_key' => $this->faker->text,
            'private_key' => $this->faker->text,
            'issued_on' => $issued_on,
            'expires_on' => $expires_on,
            'sha256_fingerprint' => $this->faker->sha256,
            'sha1_fingerprint' => $this->faker->sha1,
            'issuer_id' => null,
        ];
    }
}
