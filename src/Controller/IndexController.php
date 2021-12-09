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
     */
    public function home(): Response
    {
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
