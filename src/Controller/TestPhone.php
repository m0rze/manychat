<?php

namespace App\Controller;

use App\Services\GeneralFuncs;
use App\Services\PachkaAPI;
use libphonenumber\PhoneNumberUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestPhone extends AbstractController
{
    /**
     * @Route("/inphone", methods={"POST"})
     */
    public function recievePhone(Request $request, PachkaAPI $pachkaAPI): Response
    {
        $data = json_decode($request->getContent(), true);
        if(!empty($data["phone"])) {
            $phone = $data["phone"];
        } else {
            $phone = "";
        }
        GeneralFuncs::createWriteFile(dirname(__FILE__)."/log.txt", "a+", serialize($data)."\n".$phone."\n");
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
            $pachkaAPI->sendToPachka();
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
    public function test(PachkaAPI $pachkaAPI)
    {
        $pachkaAPI->sendToPachka("тестовое сообщение");

        return new Response("");
    }
}