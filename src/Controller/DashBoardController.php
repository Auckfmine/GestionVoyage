<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Repository\MoyenDeTransportRepository;
use App\Repository\StationRepository;
use App\Repository\UserRepository;
use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    /**
     * @Route("/user/statistiques", name="user_statistiques", methods={"GET"})
     *
     */
    public function getUserStats(UserRepository $userRepository): Response
    {

        //get all dates in the database
        $filteredUsers = $userRepository->findByExampleField('2002-06-12');
        $users = $userRepository->findAll();
        $dates = [];
        foreach ($users as $user){
            $dates[]=$user->getBirthday()->format('Y-m-d');
        }
        //build an array with this dates and delete repetition
        $filteredDates = array_unique($dates);
        $finalDates = [];
        $finalUsers = [];


        //querry for voyages for each date in the new array
        foreach ($filteredDates as $date){

            $finalDates[] =  count($userRepository->findByExampleField($date));
        }

        $userId = [];
        $userCreatedDate = [];
        $userRole = [];

        $roles =['CLIENT', 'ADMIN','RESPONSABLE_ABONNEMENT','RESPONSABLE_RECLAMATION','RESPONSABLE_MDT','RESPONSABLE_VOYAGE','RESPONSABLE_RESERVATION'] ;


        foreach($users as $user){

            $userId[] = $user->getId();
            $userCreatedDate[] =$user->getBirthday();
            $userRole[] = $user->getRole();
        }
        //$optimisedRole = array_unique($roles);
        foreach ($roles as $role){

            $finalroles[]=count($userRepository->findUserByRole($role));

        }




        return $this->render('user/stat.html.twig', [
            'userId'=>  json_encode($userId),
            'userCreatedDate'=>json_encode($userCreatedDate),
            'role'=>json_encode($roles),
            'filteredUsers'=>$filteredUsers,
            'finalDates'=>json_encode($finalDates),
            'finalroles' =>json_encode($finalroles),


        ]);
    }


    /**
     * @Route("/moyenTransport/statistiques", name="statistiques")
     */
    public function stats(): Response
    {
        return $this->render('moyen_de_transport/Statistique.html.twig');

    }

    /**
     *
     * @Route("/statistiques/type", name="type_statistiques")
     */
    public function type_stats(MoyenDeTransportRepository $moyenTransportRepo): JsonResponse
    {
        $bus = 0;
        $train = 0;
        $metro = 0;
        $moyenTransport = $moyenTransportRepo->findAll();
        foreach ($moyenTransport as $item) {
            if (strcmp(strtolower($item->getType()), "bus") == 0) $bus++;
            if (strcmp(strtolower($item->getType()), "train") == 0) $train++;
            if (strcmp(strtolower($item->getType()), "metro") == 0) $metro++;
        }
        $data = array("Bus" => $bus, "Train" => $train, "Métro" => $metro);
        return new JsonResponse($data);
    }


}
