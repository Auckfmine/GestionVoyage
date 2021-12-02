<?php

namespace App\Controller;

use App\api\MailerApi;
use App\api\TwilioApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/")
 */
class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @throws TransportExceptionInterface
     */
    public function home(MailerInterface $mailer): Response
    {
        $email = new MailerApi();
        $twilio = new TwilioApi('AC827499c505a0825c13b9c15a5e57dcde','e4c1859584e04ae1d30dcef4a2f09ba5','+14704444081');
        $twilio->sendSMS('+21625892319','hello from twilio');
        $email->sendEmail( $mailer,'mouhamedaminerouatbi@gmail.com','mouhamedaminerouatbi@gmail.com','testing email','hello from Mailer to amine ');
        return $this->render('/demo/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }


    /**
     * @Route("/map", name="map")
     *
     */

    public function maps(): Response
    {


        return $this->render('map.html', [

            'controller_name' => 'IndexController',
        ]);
    }

}
