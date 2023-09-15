<?php

namespace App\Repositories;

use App\Enums\CertificateTypeEnum;
use App\Models\Certificate;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CertificateRepository
{
    use HasUuids;
    public function __construct(
        private readonly Certificate $certificate
    ){}

    public function create(array $data)
    {
        $model = new Certificate();
        $model->fill($data);
        $model->id = $this->newUniqueId();
        if ($data['issuer'] === 'this'){
            $model->issuer()->associate($model);
        }
        return $model->save();
    }

    public function find(string $id)
    {
        return $this->certificate->find($id);
    }

    public function all()
    {
        return $this->certificate->all();
    }

    public function allIssuedBy(string $id, CertificateTypeEnum $type = null)
    {
        $certificates = $this->certificate->where('issuer', '=', $id)->whereColumn('issuer','!=', 'id')->get();
        switch ($type){
            case CertificateTypeEnum::CA:
                return $certificates->where('type', '=', CertificateTypeEnum::CA);
            case CertificateTypeEnum::SUB_CA:
                return $certificates->where('type', '=', CertificateTypeEnum::SUB_CA);
            case CertificateTypeEnum::CERT:
                return $certificates->where('type', '=', CertificateTypeEnum::CERT);
        }
        return $certificates;
    }

    public function allRootAuthorities()
    {
        return $this->certificate->all()->filter(function ($certificate){
            return $certificate->isRootAuthority();
        });
    }

    public function update(string $id, array $data)
    {
        return $this->certificate->find($id)->update($data);
    }

    public function delete(string $id)
    {
        return $this->certificate->find($id)->delete();
    }
}
