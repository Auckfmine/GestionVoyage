<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController{
    /**
     * @Route("/login",name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils){
        $lastusername=$authenticationUtils->getLastUsername();
        $error=$authenticationUtils->getLastAuthenticationError();
        return $this->render('user/login.html.twig',[
            'last_username'=>$lastusername,
            'error'=>$error
        ]);

    }
}