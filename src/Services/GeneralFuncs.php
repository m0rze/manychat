<?php

namespace App\Services;

class GeneralFuncs
{

    static public function createWriteFile($filename, $attr, $data)
    {
        if (empty($attr)) {
            $attr = "w+";
        }

        $fd = fopen($filename, $attr);
        fwrite($fd, $data);
        fclose($fd);

    }

}