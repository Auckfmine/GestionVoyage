<?php

namespace App\Controller;

use App\api\MailerApi;
use App\api\TwilioApi;
use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/")
 */
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


    /**
     * @Route("/map", name="map")
     *
     */

    public function maps(): Response
    {


        return $this->render('map.html', [

            'controller_name' => 'IndexController',
        ]);
    }


    /**
     * @Route("/rechercher", name="rechercher")
     */
    public function rechercher(Request $request, VoyageRepository $voyageRepository)
    {
        if ($request->isXmlHttpRequest()) {
            $station = $request->get('station');
            $date = $request->get('date');
            $mt = $request->get('mt');
            $req = trim($request->get('req'));
            $res = array();
            if ($req != '') {
                $res = $voyageRepository->findVoyageByStation($req);
            } else {
                $res = $voyageRepository->findAll();

            }

            $idx = 0;
            if ($station != '') {
                foreach ($res as $item) {
                    if (strtolower($item->getStationDepart()) != $station) {
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
                    'ref_voyage' => $item->getRefVoyage(),
                    'station_depart' => $item->getStationDepart()->getNomStation(),
                    'Station_arrive' => $item->getStationArrive()->getNomStation(),
                    'MoyenDeTransport' => $item->getMoyenDeTransport()->getType(),
                    'date_depart' => $item->getDateDepart()->format('Y-m-d H:i:s'),
                    'date_arrive' => $item->getDateArrive()->format('Y-m-d H:i:s'),
                );
                $jsonResponse[$idx++] = $temp;
            }
            return new JsonResponse($jsonResponse);
        } else {
            return $this->redirectToRoute("list_voyages");
        }
    }

}
