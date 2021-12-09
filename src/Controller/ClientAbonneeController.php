<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Entity\AbonnementDisponible;
use App\Repository\AbonnementDisponibleRepository;
use App\Repository\AbonnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class ClientAbonneeController extends AbstractController
{
    /**
     * @Route("/abonnement_client", name="clients_abonnee_back")
     */
    public function index(AbonnementRepository $abonn_repo): Response
    {
        return $this->render('client_abonnee/index.html.twig', [
            'clients_abonnee' => $abonn_repo->findAll()
        ]);
    }

    /**
     * @Route("/abonnement_client/edit/{id}", name="clients_abonnee_back_edit")
     */
    public function edit(Request $request, Abonnement $abonn)
    {
        if ($request->isMethod("POST")) {
            $tel = $request->request->get("tel");
            $abonn->setTel($tel);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($abonn);
            $entityManager->flush();
            $this->addFlash(
                'success',
                "L'abonnement à été modifié avec succés !"
            );
            return $this->redirectToRoute("clients_abonnee_back");
        }
        return $this->render("client_abonnee/edit.html.twig", [
            'abonn' => $abonn,
        ]);
    }

    /**
     * @Route("/abonnement_client/delete/{id}", name="clients_abonnee_back_delete")
     */
    public function delete(Abonnement $abonn)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($abonn);
        $entityManager->flush();
        $this->addFlash(
            'success',
            "L'abonnement à été supprimé avec succés !"
        );
        return $this->redirectToRoute("clients_abonnee_back");
    }
}
