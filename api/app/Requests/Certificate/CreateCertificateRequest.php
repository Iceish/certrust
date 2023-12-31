<?php

namespace App\Requests\Certificate;

use Illuminate\Foundation\Http\FormRequest;

class CreateCertificateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => 'required|numeric',
            'issuer' => 'uuid',
            'common_name' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'organization_unit' => 'required|string|max:255',
            'country_name' => 'required|string|in:FR,US,CA,AX,AD,AE,AF,AG,AI,AL,AM,AN,AO,AQ,AR,AS,AT,AU,AW,AZ,BA,BB,BD,BE,BF,BG,BH,BI,BJ,BM,BN,BO,BR,BS,BT,BV,BW,BZ,CA,CC,CF,CH,CI,CK,CL,CM,CN,CO,CR,CS,CV,CX,CY,CZ,DE,DJ,DK,DM,DO,DZ,EC,EE,EG,EH,ER,ES,ET,FI,FJ,FK,FM,FO,FR,FX,GA,GB,GD,GE,GF,GG,GH,GI,GL,GM,GN,GP,GQ,GR,GS,GT,GU,GW,GY,HK,HM,HN,HR,HT,HU,ID,IE,IL,IM,IN,IO,IS,IT,JE,JM,JO,JP,KE,KG,KH,KI,KM,KN,KR,KW,KY,KZ,LA,LC,LI,LK,LS,LT,LU,LV,LY,MA,MC,MD,ME,MG,MH,MK,ML,MM,MN,MO,MP,MQ,MR,MS,MT,MU,MV,MW,MX,MY,MZ,NA,NC,NE,NF,NG,NI,NL,NO,NP,NR,NT,NU,NZ,OM,PA,PE,PF,PG,PH,PK,PL,PM,PN,PR,PS,PT,PW,PY,QA,RE,RO,RS,RU,RW,SA,SB,SC,SE,SG,SH,SI,SJ,SK,SL,SM,SN,SR,ST,SU,SV,SZ,TC,TD,TF,TG,TH,TJ,TK,TM,TN,TO,TP,TR,TT,TV,TW,TZ,UA,UG,UM,US,UY,UZ,VA,VC,VE,VG,VI,VN,VU,WF,WS,YE,YT,ZA,ZM,COM,EDU,GOV,INT,MIL,NET,ORG,ARPA',
            'state_or_province_name' => 'required|string|max:255',
            'locality_name' => 'required|string|max:255',
            'validity_days' => 'required|numeric|min:1|max:9125', // 25 years max
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
