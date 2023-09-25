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
    public $timestamps = false;

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
        'issuer_id',
    ];

    protected $casts = [
        'expires_on' => 'datetime',
        'issued_on' => 'datetime',
        'type' => CertificateTypeEnum::class
    ];

    public function issuer(): BelongsTo
    {
        return $this->belongsTo(Certificate::class, 'issuer_id');
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class, 'issuer_id');
    }

}
