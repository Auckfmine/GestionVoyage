<?php

namespace App\Controller;

use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
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
     * @Route("/AfficheR")
     */
    function AfficheR(ReclamationRepository $repository){
        // $repository=$this->getDoctrine()->getRepository(Reclamation::class); //principe d'injection de dépendance
        $reclamation=$repository->findAll();
        return $this->render("reclamation/AfficheR.html.twig",
            ['reclamation'=>$reclamation]);
    }
    /**
     * @Route("Supp/{id}",name="d")
     */
    function Delete($id, ReclamationRepository $repository){
        $reclamation=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em=$this->remove($reclamation);
        $em=$this->flush();
        return $this->redirectToRoute('AfficheR');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("reclamation/Ajout")
     */

    function AjoutR(Request $request){
        //Appel de la vue
        //$form=$this->createFormBuilder(Reclamation::class);
        $reclamation=new Reclamation();
        $form=$this->createForm(ReclamationType::class,$reclamation)
            ->add("Ajouter",SubmitType::class);
        $form->handleRequest($request);//récupère les données à partir des inputs
        //Ajout
        if($form->isSubmitted()&& $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
        }

        //Appel de la vue
        return $this->render("reclamation/AjoutC.html.twig",
            ["f"=>$form->createView()]
        );
    }
}
