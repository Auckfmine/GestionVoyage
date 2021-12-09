<?php

namespace App\Controller;

use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reclamation;

/**
 * @method remove(Reclamation|null $reclamation)
 * @method flush()
 */
class ReclamationController extends AbstractController
{
    /**
     * @Route("/reclamation", name="reclamation")
     */
    public function index(): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }

    /**
     * @Route("/AfficheR",name="afficher_reclamation")
     */
    function AfficheR(ReclamationRepository $repository){
        // $repository=$this->getDoctrine()->getRepository(Reclamation::class); //principe d'injection de dépendance
        $reclamation=$repository->findAll();
        return $this->render("reclamation/AfficheR.html.twig",
            ['reclamations'=>$reclamation]);
    }
    /**
     * @Route("Supp/{id}",name="d")
     */
    function Delete(int $id){
        $entityManager = $this->getDoctrine()->getManager();
        $reclamation = $entityManager->getRepository(Reclamation::class)->find($id);
        $entityManager->remove($reclamation);
        $entityManager->flush();

        return $this->redirectToRoute("afficher_reclamation");
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("reclamation/Ajout",name="ajouter_reclamation")
     */

    function AjoutR(Request $request){
        //Appel de la vue
        //$form=$this->createFormBuilder(Reclamation::class);
        $reclamation=new Reclamation();
        $form=$this->createForm(ReclamationType::class,$reclamation);
        $form->handleRequest($request);//récupère les données à partir des inputs
        //Ajout
        if($form->isSubmitted()&& $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute("afficher_reclamation");

        }

        //Appel de la vue
        return $this->render("reclamation/form.html.twig",
            ["form"=>$form->createView()]
        );
    }
    /**
     * @Route("/{id}/edit", name="update_reclamation", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('afficher_reclamation', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamation/form.html.twig', [
            'reclamations' => $reclamation,
            'form' => $form->createView(),
        ]);
    }
}
