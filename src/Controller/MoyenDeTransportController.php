<?php

namespace App\Controller;

use App\api\MailerApi;
use App\api\TwilioApi;
use App\Entity\MoyenDeTransport;
use App\Form\MoyenDeTransportType;
use App\Repository\MoyenDeTransportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Knp\Component\Pager\PaginatorInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/moyen/de/transport")
 */
class MoyenDeTransportController extends AbstractController
{
    /**
     * @Route("/", name="moyen_de_transport_index", methods={"GET"})
     */
    public function index(MoyenDeTransportRepository $moyenDeTransportRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $donnees = $this->getDoctrine()->getRepository(MoyenDeTransport::class)->findBy([],['Prix_Achat' => 'asc']);

        $moyen_de_transports = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page

        );

        return $this->render('moyen_de_transport/index.html.twig', [
            'moyen_de_transports' => $moyen_de_transports
        ]);
    }


    /**
     * @Route("/ListMoyen", name="moyen_transport_list", methods={"GET"})
     */
    public function listMoyen(MoyenDeTransportRepository $moyenDeTransportRepository): Response
    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $moyen_de_transports = $moyenDeTransportRepository->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('moyen_de_transport/ListMoyenTransport.html.twig', [
            'moyen_de_transports' => $moyen_de_transports
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("MoyenTransport.pdf", [
            "Attachment" => true
        ]);

        return $this->render('moyen_de_transport/ListMoyenTransport.html.twig', [
            'moyen_de_transports' => $moyen_de_transports
        ]);
    }




    /**
     * @Route("/new", name="moyen_de_transport_new", methods={"GET", "POST"})
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function new(Request $request, EntityManagerInterface $entityManager,MailerInterface $mailer,FlashyNotifier $flashy): Response
    {
        $moyenDeTransport = new MoyenDeTransport();
        $form = $this->createForm(MoyenDeTransportType::class, $moyenDeTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($moyenDeTransport);
            $entityManager->flush();


            $email = new MailerApi();
            $twilio = new TwilioApi('ACcb016d5d5b4e05ea366d44ec5227e10c','ac4747a918aeb184c86281050488de22','+12565679612');
            $twilio->sendSMS('+21658932889','Moyen de Transport Créer avec success');
            $email->sendEmail( $mailer,'tunisport32@gmail.com','mahdi.homrani@esprit.tn','testing email','Moyen de Transport Créer avec success');
            $this->addFlash(
                'info' ,' Moyen de Transport ajoute !');

            return $this->redirectToRoute('moyen_de_transport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('moyen_de_transport/new.html.twig', [
            'moyen_de_transport' => $moyenDeTransport,
            'form' => $form->createView(),
        ]);


    }

    /**
     * @Route("/{id}", name="moyen_de_transport_show", methods={"GET"})
     */
    public function show(MoyenDeTransport $moyenDeTransport): Response
    {
        return $this->render('moyen_de_transport/show.html.twig', [
            'moyen_de_transport' => $moyenDeTransport,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="moyen_de_transport_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, MoyenDeTransport $moyenDeTransport, EntityManagerInterface $entityManager,MailerInterface $mailer,FlashyNotifier $flashy): Response
    {
        $form = $this->createForm(MoyenDeTransportType::class, $moyenDeTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $email = new MailerApi();
            $twilio = new TwilioApi('ACcb016d5d5b4e05ea366d44ec5227e10c','ac4747a918aeb184c86281050488de22','+12565679612');
            $twilio->sendSMS('+21658932889','Moyen de Transport Modifier avec success');
            $email->sendEmail( $mailer,'tunisport32@gmail.com','mahdi.homrani@esprit.tn','testing email','Moyen de Transport Modifier avec success');
            $this->addFlash(
                'info' ,' Moyen de Transport Modifier avec success !');

            return $this->redirectToRoute('moyen_de_transport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('moyen_de_transport/edit.html.twig', [
            'moyen_de_transport' => $moyenDeTransport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="moyen_de_transport_delete", methods={"POST"})
     */
    public function delete(Request $request, MoyenDeTransport $moyenDeTransport, EntityManagerInterface $entityManager,MailerInterface $mailer,FlashyNotifier $flashy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$moyenDeTransport->getId(), $request->request->get('_token'))) {
            $entityManager->remove($moyenDeTransport);
            $entityManager->flush();

            $email = new MailerApi();
            $twilio = new TwilioApi('ACcb016d5d5b4e05ea366d44ec5227e10c','ac4747a918aeb184c86281050488de22','+12565679612');
            $twilio->sendSMS('+21658932889','Moyen de Transport Supprimer avec success');
            $email->sendEmail( $mailer,'tunisport32@gmail.com','mahdi.homrani@esprit.tn','testing email','Moyen de Transport Supprimer avec success');
            $this->addFlash(
                'info' ,' Moyen de Transport Supprimer avec success !');
        }

        return $this->redirectToRoute('moyen_de_transport_index', [], Response::HTTP_SEE_OTHER);
    }


}