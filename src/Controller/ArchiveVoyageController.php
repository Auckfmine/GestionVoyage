<?php

namespace App\Controller;

use App\api\MailerApi;
use App\api\TwilioApi;
use App\Entity\MoyenDeTransport;
use App\Entity\Station;
use App\Entity\Voyage;
use App\Entity\VoyageArchive;
use App\Form\VoyageType;
use App\Repository\MoyenDeTransportRepository;
use App\Repository\StationRepository;
use App\Repository\VoyageArchiveRepository;
use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ArchiveVoyageController extends AbstractController
{
    /**
     * @Route("/archive/voyage", name="archive")
     */
    public function index(VoyageArchiveRepository $voyageArchiveRepository): Response
    {
        return $this->render('archive_voyage/index.html.twig', [
            'controller_name' => 'ArchiveVoyageController',
            'voyages' => $voyageArchiveRepository->findAll(),
        ]);
    }
    /**
     * @Route("/archive/add/{id}", name="archive_voyage")
     */
    public function new(MailerInterface $mailer,Voyage $voyage,VoyageRepository $voyageRepository): Response
    {
         $voyageArchive = new VoyageArchive();
         $voyageArchive->setRefVoyage($voyage->getRefVoyage());
         $voyageArchive->setStationDepart($voyage->getStationDepart()->getId());
         $voyageArchive->setMoyenDeTransport($voyage->getMoyenDeTransport()->getId());
         $voyageArchive->setDateDepart($voyage->getDateDepart());
         $voyageArchive->setDateArrive($voyage->getDateArrive());
         $voyageArchive->setStationArrive($voyage->getStationArrive()->getId());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($voyageArchive);
        $entityManager->flush();

        $entityManager->remove($voyage);
        $entityManager->flush();

        return $this->redirectToRoute('voyage_index', [],Response::HTTP_SEE_OTHER);
    }



}
