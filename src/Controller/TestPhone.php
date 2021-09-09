<?php

namespace App\Controller;

use libphonenumber\PhoneNumberUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestPhone
{
    /**
     * @Route("/inphone", methods={"POST"})
     */
    public function recievePhone(Request $request): Response
    {
        $phone = $request->request->get("phone");
        return new Response("");
    }

    /**
     * @Route("/test")
     */
    public function test()
    {
        $testNum = "89783847541";
        $checkPhone = PhoneNumberUtil::getInstance();
        try{
            $testNum = $checkPhone->parse($testNum, "RU");
            $isValid = $checkPhone->isValidNumber($testNum);
        } catch (\Exception $exception){
            $isValid = false;
        }

        return new Response("");
    }
}