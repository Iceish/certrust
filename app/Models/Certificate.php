<?php

namespace App\Models;

use App\Enums\CertificateTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasUuids;
    protected $fillable = [
        'type',
        'common_name',
        'organization',
        'organization_unit',
        'country_name',
        'state_or_province_name',
        'locality_name',
        'public_key',
        'private_key',
        'expires_on',
        'issued_on',
        'sha256_fingerprint',
        'sha1_fingerprint',
        'issuer',
    ];

    protected $casts = [
        'expires_on' => 'datetime',
        'issued_on' => 'datetime',
        'type' => CertificateTypeEnum::class
    ];

    public function issuer()
    {
        return $this->belongsTo(Certificate::class, 'issuer');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'issuer');
    }

    public function isAuthority()
    {
        return ($this->type === CertificateTypeEnum::CA) || ($this->type === CertificateTypeEnum::SUB_CA);
    }

    public function isRootAuthority()
    {
        return $this->type === CertificateTypeEnum::CA;
    }

}
