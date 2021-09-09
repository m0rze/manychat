<?php

namespace App\Services;

class PachkaAPI
{
    public function sendToPachka()
    {
        GeneralFuncs::createWriteFile(dirname(__FILE__)."/log.txt", "a+", "SENDED");
    }
}