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
        $testNum = "89ss263847591";
        $checkPhone = PhoneNumberUtil::getInstance();
        //$testNum = $checkPhone->parse($testNum);
        $isValid = $checkPhone->isValidNumber($testNum);
        dd($isValid);
    }
}