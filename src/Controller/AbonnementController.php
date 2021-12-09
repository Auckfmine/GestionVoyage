<?php

namespace App\Controller;

use Twilio\Rest\Client;
use App\Entity\Abonnement;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use App\Entity\AbonnementDisponible;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AbonnementController extends AbstractController
{
    /**
     * @Route("/abonnement/new/{id}", name="new_abonnement")
     */
    public function index(MailerInterface $mailer, Request $request, AbonnementDisponible $abonnementDisponible, UserRepository $userRepo): Response
    {
        $abonnement = new Abonnement();

        if ($request->isMethod("POST")) {

            $tel = $request->request->get("tel");
            $periode = $request->request->get("periode");
            $date_deb = new \DateTime();
            $date_fin = new \DateTime();
            $date_fin->modify("+ $periode month");
            $prix = $request->request->get("prix");

            $abonnement->setDateDebut($date_deb);
            $abonnement->setDateFin($date_fin);
            $abonnement->setTel($tel);
            $abonnement->setPrix($prix);

            $user = $userRepo->findOneBy(['id' => 1]);

            $abonnement->setAbonnementDisponible($abonnementDisponible);
            $abonnement->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($abonnement);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "Vous etes maintenant abonnée !"
            );

            //SEND SMS
            $sid = "AC3178714705f233f4d9661d3531c30863"; // Your Account SID from www.twilio.com/console
            $token = "3e6cbfffed03e07e8b65efc37548b4f2"; // Your Auth Token from www.twilio.com/console

            $client = new Client($sid, $token);
            $message = $client->messages->create(
                "+216" . $tel, // Text this number
                [
                    'from' => '3186109336', // From a valid Twilio number
                    'body' => 'Hello from Twilio!'
                ]
            );

            //SEND MAIL
            $email = (new Email())
                ->from('tunisport32@gmail.com')
                ->to('mohamedsaid.bouchouicha@esprit.tn')
                ->subject('Vous etes maintenant abonnée !')
                ->text('Votre abonnement à été éffecutuer avec succées')
                ->html("<p>L'equipe tunisport.</p>");

            $mailer->send($email);

            return $this->redirectToRoute("abonnement_disponible_index");
        }

        return $this->render('abonnement/index.html.twig', [
            "abonnementDisponible" => $abonnementDisponible
        ]);
    }
}
