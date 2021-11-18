<?php

namespace App\Controller;

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
        return $this->render('main_front/preview.themeforest.net/item/conexi-online-taxi-booking-service-html-template/full_screen_preview/245209188627.html', [
            'controller_name' => 'IndexController',
        ]);
    }
}
