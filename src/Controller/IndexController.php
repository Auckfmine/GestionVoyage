<?php

namespace App\Controller;

use App\api\MailerApi;
use App\api\TwilioApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function home(MailerInterface $mailer): Response
    {
        $email = new MailerApi();
        $twilio = new TwilioApi();
        $twilio->sendSMS('+21625892319','hello from twilio');
        $email->sendEmail( $mailer,'mouhamedaminerouatbi@gmail.com','mouhamedaminerouatbi@gmail.com','testing email','hello from Mailer to amine ');
        return $this->render('/demo/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
