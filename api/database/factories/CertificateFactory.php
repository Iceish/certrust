<?php

namespace Database\Factories;

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    protected $model = Certificate::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement([0,1,2]),
            'common_name' => $this->faker->domainName,
            'organization' => $this->faker->company,
            'organization_unit' => $this->faker->companySuffix,
            'country_name' => $this->faker->countryCode,
            'state_or_province_name' => $this->faker->state,
            'locality_name' => $this->faker->city,
            'public_key' => $this->faker->text,
            'private_key' => $this->faker->text,
            'expires_on' => $this->faker->dateTimeInInterval('now', '+ 1 year'),
            'issued_on' => $this->faker->dateTime,
            'sha256_fingerprint' => $this->faker->sha256,
            'sha1_fingerprint' => $this->faker->sha1,
            'issuer' => rand(0,1) ? Certificate::factory() : null,
        ];
    }
}
