<?php

namespace App\Controller;

use App\Services\GeneralFuncs;
use App\Services\ManyChatAPI;
use libphonenumber\PhoneNumberUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestPhone
{
    /**
     * @Route("/inphone", methods={"GET"})
     */
    public function recievePhone(Request $request): Response
    {

        $phone = $request->request->get("phone");
        GeneralFuncs::createWriteFile(dirname(__FILE__)."/log.txt", "a+", serialize($_REQUEST)."\n".$phone."\n");
        $checkPhone = PhoneNumberUtil::getInstance();
        try{
            $phone = $checkPhone->parse($phone, "RU");
            $isValid = $checkPhone->isValidNumber($phone);

        } catch (\Exception $exception){
            $isValid = false;
        }
        GeneralFuncs::createWriteFile(dirname(__FILE__)."/log.txt", "a+", $isValid."\n");
        if($isValid) {
            $response = json_encode(array(
                "answer" => "Спасибо, мы Вам перезвоним"
            ));
            return new Response($response);
        } else {
            $response = json_encode(array(
                "answer" => "badphone"
            ));
            return new Response($response);
        }
    }

    /**
     * @Route("/test")
     */
    public function test()
    {
        var_dump(dirname(__FILE__));die();
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