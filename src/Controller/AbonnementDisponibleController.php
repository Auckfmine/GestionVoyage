<?php

namespace App\Controller;

use App\Entity\AbonnementDisponible;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AbonnementDisponibleRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/abonnements")
 */
class AbonnementDisponibleController extends AbstractController
{
    /**
     * @Route("/", name="abonnement_disponible_index", methods={"GET"})
     */
    public function index(AbonnementDisponibleRepository $abonnementDisponibleRepository): Response
    {
        return $this->render('abonnement_disponible/affichage_front.html.twig', [
            'abonnement_disponibles' => $abonnementDisponibleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/rechercher", name="rechercher")
     */
    public function rechercher(Request $request, AbonnementDisponibleRepository $abonDispoRepo)
    {
        if ($request->isXmlHttpRequest()) {
            $type = $request->get('type');
            $prix = $request->get('prix');
            $req = trim($request->get('req'));
            $res = array();
            if ($req != '') {
                $res = $abonDispoRepo->findByDescriptionOrdered($req, $prix);
            } else {
                $res = $abonDispoRepo->findAllOrdered($prix);
            }

            $idx = 0;
            if ($type != '') {
                foreach ($res as $item) {
                    if (strtolower($item->getType()) != $type) {
                        unset($res[$idx]);
                    }
                    $idx++;
                }
            }

            $jsonResponse = array();
            $idx = 0;
            foreach ($res as $item) {
                $temp = array(
                    'id' => $item->getId(),
                    'descr' => $item->getDescr(),
                    'type' => $item->getType(),
                    'prix_mois' => $item->getPrixMois(),
                    'prix_semestre' => $item->getPrixSemestre(),
                    'prix_annuel' => $item->getPrixAnnuel(),
                );
                $jsonResponse[$idx++] = $temp;
            }
            return new JsonResponse($jsonResponse);
        } else {
            return $this->redirectToRoute("abonnement_disponible_index");
        }
    }

    /**
     * @Route("/{id}", name="abonnement_disponible_show", methods={"GET"})
     */
    public function show(AbonnementDisponible $abonnementDisponible): Response
    {
        return $this->render('abonnement_disponible/show.html.twig', [
            'abonnement_disponible' => $abonnementDisponible,
        ]);
    }
}
