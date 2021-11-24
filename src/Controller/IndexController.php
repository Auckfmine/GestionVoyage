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
        return $this->render('/demo/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
