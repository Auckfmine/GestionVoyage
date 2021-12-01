<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashBoardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dash_board")
     */
    public function index(): Response
    {
        return $this->render('dashboard.html.twig', [
            'controller_name' => 'DashBoardController',
        ]);
    }
    /**
     * @Route("/voyage/statistiques", name="voyage_statistiques", methods={"GET"})
     *
     */
    public function getVoyageStats(VoyageRepository $voyageRepository): Response
    {
        $filteredVoyages = $voyageRepository->findByExampleField('1');
        $voyages = $voyageRepository->findAll();

        $voyageRef = [];
        $voyageDateDepart = [];
        $voyageStation = [];
        $voyageMoyenTransport = [];


        foreach($voyages as $voyage){
            $voyageRef[] = $voyage->getRefVoyage();
            $voyageDateDepart[] =$voyage->getDateDepart();
            $voyageStation[] = $voyage->getStationDepart()->getNomStation();
            $voyageMoyenTransport[] = $voyage->getMoyenDeTransport();
        }

        return $this->render('voyage/stat.html.twig', [
            'voyageRef'=>  json_encode($voyageRef),
            'voyageDateDepart'=>json_encode($voyageDateDepart),
            'voyageStation'=>json_encode($voyageStation),
            'voyageMt'=>json_encode($voyageMoyenTransport),
            'filteredVoyages'=>json_encode($filteredVoyages)
        ]);
    }





}
