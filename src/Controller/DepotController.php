<?php

namespace App\Controller;

use App\api\MailerApi;
use App\api\TwilioApi;
use App\Entity\Depot;
use App\Form\DepotType;
use App\Repository\DepotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Mailer\MailerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/depot")
 */
class DepotController extends AbstractController
{
    /**
     * @Route("/", name="depot_index", methods={"GET"})
     */
    public function index(DepotRepository $depotRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Depot::class)->findBy([],['Capacite' => 'asc']);

        $depots = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page

        );

        return $this->render('depot/index.html.twig', [
            'depots' => $depots
        ]);

    }

    /**
     * @Route("/Depotliste", name="depot_liste_front")
     */
    public function listVoy(DepotRepository $depotRepository): Response
    {
        return $this->render('demo/destination-fullwidth/DepotsShow.html.twig', [
            'Depots' => $depotRepository->findAll(),
        ]);
    }


    /**
     * @Route("/ListDepot", name="depot_list", methods={"GET"})
     */
    public function listDepot(DepotRepository $depotRepository): Response
    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $depots = $depotRepository->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('depot/ListDepot.html.twig', [
            'depots' => $depots
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Depots.pdf", [
            "Attachment" => true
        ]);

        return $this->render('depot/ListDepot.html.twig', [
            'depots' => $depots
        ]);
    }

    /**
     * @Route("/Depot_detail/{id}", name="Depot_detail", methods={"GET"})
     */
    public function voyageDetail(Depot $depot): Response
    {
        return $this->render('demo/tour/niko-trip/DepotDetailsliste.html.twig', [
            'Depot' => $depot,
        ]);
    }

    /**
     * @Route("/map")
     */
    public function mapAction()
    {
        return $this->render('depot/newMap.html.twig');
    }

    /**
     * @Route("/new", name="depot_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,MailerInterface $mailer,FlashyNotifier $flashy): Response
    {
        $depot = new Depot();
        $form = $this->createForm(DepotType::class, $depot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($depot);
            $entityManager->flush();

            $email = new MailerApi();
            $twilio = new TwilioApi('ACcb016d5d5b4e05ea366d44ec5227e10c','ac4747a918aeb184c86281050488de22','+12565679612');
            $twilio->sendSMS('+21658932889','Depot Créer avec success');
            $email->sendEmail( $mailer,'tunisport32@gmail.com','mahdi.homrani@esprit.tn','testing email','Depot Créer avec success');
            $this->addFlash(
                'info' ,' Depot Créer avec success !');

            return $this->redirectToRoute('depot_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('depot/new.html.twig', [
            'depot' => $depot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="depot_show", methods={"GET"})
     */
    public function show(Depot $depot): Response
    {
        return $this->render('depot/show.html.twig', [
            'depot' => $depot,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="depot_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Depot $depot, EntityManagerInterface $entityManager,MailerInterface $mailer,FlashyNotifier $flashy): Response
    {
        $form = $this->createForm(DepotType::class, $depot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $email = new MailerApi();
            $twilio = new TwilioApi('ACcb016d5d5b4e05ea366d44ec5227e10c','ac4747a918aeb184c86281050488de22','+12565679612');
            $twilio->sendSMS('+21658932889','Depot Modifier avec success');
            $email->sendEmail( $mailer,'tunisport32@gmail.com','mahdi.homrani@esprit.tn','testing email','Depot Modifier avec success');
            $this->addFlash(
                'info' ,' Depot Modifier avec success !');

            return $this->redirectToRoute('depot_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('depot/edit.html.twig', [
            'depot' => $depot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="depot_delete", methods={"POST"})
     */
    public function delete(Request $request, Depot $depot, EntityManagerInterface $entityManager,MailerInterface $mailer,FlashyNotifier $flashy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$depot->getId(), $request->request->get('_token'))) {
            $entityManager->remove($depot);
            $entityManager->flush();

            $email = new MailerApi();
            $twilio = new TwilioApi('ACcb016d5d5b4e05ea366d44ec5227e10c','ac4747a918aeb184c86281050488de22','+12565679612');
            $twilio->sendSMS('+21658932889','Depot Supprimer avec success');
            $email->sendEmail( $mailer,'tunisport32@gmail.com','mahdi.homrani@esprit.tn','testing email','Depot Supprimer avec success');
            $this->addFlash(
                'info' ,' Depot Supprimer avec success!');
        }

        return $this->redirectToRoute('depot_index', [], Response::HTTP_SEE_OTHER);
    }
}
