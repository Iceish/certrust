<?php

namespace App\Models;

use App\Enums\CertificateTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Certificate extends Model
{
    use HasUuids, HasFactory;
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

    public function issuer(): BelongsTo
    {
        return $this->belongsTo(Certificate::class, 'issuer');
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class, 'issuer');
    }

    public function countCertificatesByType(): array
    {
        $certificates = $this->certificates();
        return [
            'sub_ca' => $certificates->where('type', CertificateTypeEnum::SUB_CA)->count(),
            'cert' => $certificates->where('type', CertificateTypeEnum::CERT)->count()
        ];
    }

    public function isAuthority(): bool
    {
        return ($this->type === CertificateTypeEnum::CA) || ($this->type === CertificateTypeEnum::SUB_CA);
    }

    public function isRootAuthority(): bool
    {
        return $this->type === CertificateTypeEnum::CA;
    }

    public function hasExpired()
    {
        return $this->expires_on->isPast();
    }
    public function expireSoon(): bool
    {
        return $this->expires_on->diffInDays(now()) < 30 && !$this->hasExpired();
    }

}
