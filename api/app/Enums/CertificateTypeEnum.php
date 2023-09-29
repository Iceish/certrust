<?php

namespace App\Enums;

enum CertificateTypeEnum:int {
    case CA = 0;
    case SUB_CA = 1;
    case CERT = 2;
}
