<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("category/Ajout",name="ajouter_category")
     */
    function AjoutC(Request $request){
        //Appel de la vue
        //$form=$this->createFormBuilder(Reclamation::class);
        $category=new Category();
        $form=$this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);//récupère les données à partir des inputs
        //Ajout
        if($form->isSubmitted()&& $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute("afficher_category");

        }

        //Appel de la vue
        return $this->render("category/form.html.twig",
            ["form"=>$form->createView()]
        );
    }
    /**
     * @Route("/AfficheC",name="afficher_category")
     */
    function AfficheC(CategoryRepository $repository){
        // $repository=$this->getDoctrine()->getRepository(Reclamation::class); //principe d'injection de dépendance
        $category=$repository->findAll();
        return $this->render("category/AfficheC.html.twig",
            ['categoryy'=>$category]);
    }
    /**
     * @Route("Supprimer/{id}",name="delete")
     */
    function Delete(int $id){
        $entityManager = $this->getDoctrine()->getManager();
        $category = $entityManager->getRepository(Category::class)->find($id);
        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute("afficher_category");
    }
    /**
     * @Route("/{id}/update", name="update_category", methods={"GET", "POST"})
     */
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('afficher_category', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('category/form.html.twig', [
            'categoryy' => $category,
            'form' => $form->createView(),
        ]);
    }

}