<?php

namespace App\Controller;

use App\Entity\AbonnementDisponible;
use App\Form\AbonnementDisponibleType;
use App\Repository\AbonnementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use App\Repository\AbonnementDisponibleRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class AbonnementBackController extends AbstractController
{
    /**
     * @Route("/", name="index_back")
     */
    public function index(): Response
    {
        return $this->render('abonnement_back/index.html.twig');
    }

    /**
     * @Route("/abonnements", name="abonnements_back")
     */
    public function abonnements_affichage(AbonnementDisponibleRepository $abonnementDisponibleRepository)
    {
        return $this->render("abonnement_back/show.html.twig", [
            'abonnement_disponibles' => $abonnementDisponibleRepository->findAll()
        ]);
    }

    /**
     * @Route("/abonnements/new", name="abonnement_disponible_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $abonnementDisponible = new AbonnementDisponible();
        $form = $this->createForm(AbonnementDisponibleType::class, $abonnementDisponible);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($abonnementDisponible);
            $entityManager->flush();
            $this->addFlash(
                'success',
                "L'abonnement à été ajouté avec succés !"
            );
            return $this->redirectToRoute('abonnements_back');
        }

        return $this->render('abonnement_back/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/abonnements/{id}/modifier", name="abonnement_disponible_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AbonnementDisponible $abonnementDisponible): Response
    {

        $form = $this->createForm(AbonnementDisponibleType::class, $abonnementDisponible);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                "L'abonnement à été modifié avec succés !"
            );
            return $this->redirectToRoute('abonnements_back');
        }

        return $this->render('abonnement_back/edit.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/abonnements/{id}/supprimer", name="abonnement_disponible_delete")
     */
    public function delete(AbonnementDisponible $abonnementDisponible): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($abonnementDisponible);
        $entityManager->flush();
        $this->addFlash(
            'success',
            "L'abonnement à été supprimé avec succés !"
        );
        return $this->redirectToRoute('abonnements_back');
    }

    /**
     * @Route("/abonnements/statistiques", name="statistiques")
     */
    public function stats(AbonnementRepository $abonn_repo, AbonnementDisponibleRepository $abonnDispoRepo)
    {
        $abonns = $abonn_repo->findAll();
        $nb_abonnee = count($abonns);
        $nb_abonnee_last_month = $abonn_repo->countAbonneeLastMonth();
        $total = 0;
        $abonn_dispo = $abonnDispoRepo->findAll();
        $nb_abonn_dispo = count($abonn_dispo);
        foreach ($abonns as $item) {
            $total += $item->getPrix();
        }
        return $this->render("abonnement_back/statistiques.html.twig", [
            'nb_abonnee' => $nb_abonnee,
            'total' => $total,
            'nb_abonn_dispo' => $nb_abonn_dispo,
            'nb_abonnee_last_month' => $nb_abonnee_last_month
        ]);
    }

    /**
     * @Route("/abonnements/statistiques/type", name="type_statistiques")
     */
    public function type_stats(AbonnementDisponibleRepository $abonnDispoRepo)
    {
        $bus = 0;
        $train = 0;
        $metro = 0;
        $abonnDispo = $abonnDispoRepo->findAll();
        foreach ($abonnDispo as $item) {
            if (strcmp(strtolower($item->getType()), "bus") == 0) $bus++;
            if (strcmp(strtolower($item->getType()), "train") == 0) $train++;
            if (strcmp(strtolower($item->getType()), "metro") == 0) $metro++;
        }
        $data = array("Bus" => $bus, "Train" => $train, "Métro" => $metro);
        return new JsonResponse($data);
    }

    /**
     * @Route("/abonnements/statistiques/abonnee", name="abonnee_type_statistiques")
     */
    public function abonne_type_stats(AbonnementRepository $abonn_repo)
    {
        $abonnee_bus = $abonn_repo->countAbonneeParType("bus");
        $abonnee_train = $abonn_repo->countAbonneeParType("train");
        $abonnee_metro = $abonn_repo->countAbonneeParType("metro");
        $data = array("Bus" => $abonnee_bus, "Train" => $abonnee_train, "Métro" => $abonnee_metro);
        return new JsonResponse($data);
    }
}
