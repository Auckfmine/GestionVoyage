<?php

namespace App\Controller;

use App\api\MailerApi;
use App\api\TwilioApi;
use App\Entity\Voyage;
use App\Form\VoyageType;
use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/voyage")
 */
class VoyageController extends AbstractController
{
    /**
     * @Route("/", name="voyage_index", methods={"GET"})
     */
    public function index(VoyageRepository $voyageRepository): Response
    {
        return $this->render('voyage/index.html.twig', [
            'voyages' => $voyageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/listVoyages", name="list_voyages", methods={"GET"})
     */
    public function listVoy(VoyageRepository $voyageRepository): Response
    {
        return $this->render('demo/tours/tour-3-columns-video-header/voyageShowCase.html.twig', [
            'voyages' => $voyageRepository->findAll(),
        ]);
    }
    
    /**
     * @Route("/fetch", name="voyage_fetch", methods={"GET"})
     */
    public function fetch(VoyageRepository $voyageRepository): Response
    {
        return $this->render('frontOffice/index-2.html.twig', [
            'voyages' => $voyageRepository->findAll(),

        ]);
    }

    /**
     * @Route("/voyage-detail/{id}", name="voyage_detail", methods={"GET"})
     */
    public function voyageDetail(Voyage $voyage): Response
    {
        return $this->render('demo/tour/french-autumn/detailVoyage.html.twig', [
            'voyage' => $voyage,
        ]);
    }


    /**
     * @Route("/new", name="voyage_new", methods={"GET","POST"})
     */
    public function new(MailerInterface $mailer,Request $request): Response
    {
        $voyage = new Voyage();
        $form = $this->createForm(VoyageType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voyage);
            $entityManager->flush();


            $email = new MailerApi();
            $twilio = new TwilioApi('AC827499c505a0825c13b9c15a5e57dcde','4cfb02c2f12463bcefeddd3679f28005','+14704444081');
            $twilio->sendSMS('+21625892319',"le voyage ayant le code : {$voyage->getRefVoyage()} a été bien ajouté ");
           // $email->sendEmail( $mailer,'mouhamedaminerouatbi@gmail.com','mouhamedaminerouatbi@gmail.com','testing email',"le voyage ayant le code : {$voyage->getRefVoyage()} a été bien ajouté ");


            return $this->redirectToRoute('voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voyage/new.html.twig', [
            'voyage' => $voyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voyage_show", methods={"GET"})
     */
    public function show(Voyage $voyage): Response
    {
        return $this->render('voyage/show.html.twig', [
            'voyage' => $voyage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="voyage_edit", methods={"GET","POST"})
     */
    public function edit(MailerInterface $mailer,Request $request, Voyage $voyage): Response
    {
        $form = $this->createForm(VoyageType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $email = new MailerApi();
            $twilio = new TwilioApi('AC827499c505a0825c13b9c15a5e57dcde','4cfb02c2f12463bcefeddd3679f28005','+14704444081');
            $twilio->sendSMS('+21625892319',"le voyage ayant le code : {$voyage->getRefVoyage()} a été bien modifié ");
            //$email->sendEmail( $mailer,'mouhamedaminerouatbi@gmail.com','mouhamedaminerouatbi@gmail.com','testing email',"le voyage ayant le code : {$voyage->getRefVoyage()} a été bien modifié ");



            return $this->redirectToRoute('voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voyage/edit.html.twig', [
            'voyage' => $voyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voyage_delete", methods={"POST"})
     * @throws TransportExceptionInterface
     */
    public function delete(MailerInterface $mailer,Request $request, Voyage $voyage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voyage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voyage);
            $entityManager->flush();

            $email = new MailerApi();
            $twilio = new TwilioApi('AC827499c505a0825c13b9c15a5e57dcde','4cfb02c2f12463bcefeddd3679f28005','+14704444081');
            $twilio->sendSMS('+21625892319',"le voyage ayant le code : {$voyage->getRefVoyage()} a été bien supprimé ");
            $email->sendEmail( $mailer,'mouhamedaminerouatbi@gmail.com','mouhamedaminerouatbi@gmail.com','testing email',"le voyage ayant le code : {$voyage->getRefVoyage()} a été bien supprimé ");

        }

        return $this->redirectToRoute('voyage_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/archive/{id}", name="voyage_archive", methods={"POST"})
     * @throws TransportExceptionInterface
     */






}
