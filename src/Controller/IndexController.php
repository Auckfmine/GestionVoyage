<?php

namespace App\Controller;

use App\api\TwilioApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function home(): Response
    {

        $twilio = new TwilioApi();
        $twilio->sendSMS('+21625892319','hello from twilio');
        return $this->render('/demo/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
