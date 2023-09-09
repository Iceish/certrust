<?php

namespace App\Services;
class OpensslService
{
    public function getVersion(){
        ob_start();
        system('openssl version');
        $version = ob_get_contents();
        ob_end_clean();
        return($version);
    }
}
