<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Repository\MoyenDeTransportRepository;
use App\Repository\StationRepository;
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
    public function getVoyageStats(MoyenDeTransportRepository $moyenDeTransportRepository,StationRepository $stationRepository,VoyageRepository $voyageRepository): Response
    {

        //get all dates in the database
        $filteredVoyages = $voyageRepository->findByExampleField('2016-01-01');
        $voyages = $voyageRepository->findAll();
        $dates = [];
        foreach ($voyages as $voyage){
            $dates[]=$voyage->getDateDepart()->format('Y-m-d H:i:s');
        }
        //build an array with this dates and delete repetition
        $filteredDates = array_unique($dates);
        $finalDates = [];
        $finalStations = [];
        $finalMoyens = [];

        //querry for voyages for each date in the new array
        foreach ($filteredDates as $date){

           $finalDates[] =  count($voyageRepository->findByExampleField($date));
        }

        $voyageRef = [];
        $voyageDateDepart = [];
        $voyageStation = [];
        $voyageMoyenTransport = [];
        $moyenDeTransports = [];
        $stations =[] ;
        $allStations = $stationRepository->findAll();
        foreach ($allStations as $allStation){
            $stations[]= $allStation->getNomStation();
        }
        $allMoyenTransport = $moyenDeTransportRepository->findAll();

        foreach ($allMoyenTransport as $moyen){
            $moyenDeTransports[]=$moyen->getType();
        }
        $optimisedMt = array_unique($moyenDeTransports);

        foreach($voyages as $voyage){

            $voyageRef[] = $voyage->getRefVoyage();
            $voyageDateDepart[] =$voyage->getDateDepart();
            $voyageStation[] = $voyage->getStationDepart()->getNomStation();
            $voyageMoyenTransport[] = $voyage->getMoyenDeTransport();
        }
        $optimisedVoyageStation = array_unique($stations);
        foreach ($optimisedVoyageStation as $station){

            $finalStations[]=count($voyageRepository->findVoyageByStation($station));

    }

        foreach ($optimisedMt as $moyen){
            $finalMoyens[]=count($voyageRepository->findVoyageByMoyenDeTransport($moyen));
        }


        return $this->render('voyage/stat.html.twig', [
            'voyageRef'=>  json_encode($voyageRef),
            'voyageDateDepart'=>json_encode($voyageDateDepart),
            'voyageStation'=>json_encode($stations),
            'voyageMt'=>json_encode($moyenDeTransports),
            'filteredVoyages'=>$filteredVoyages,
            'finalDates'=>json_encode($finalDates),
            'finalStations' =>json_encode($finalStations),
            'finalMt'=>json_encode($finalMoyens)

        ]);
    }





}
