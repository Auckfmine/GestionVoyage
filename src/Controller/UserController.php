<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class UserController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login()
    {


        return $this->render('user/login.html.twig');
    }

    /**
     * @Route("/user", name="user")
     */
    public function user()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('user/index.html.twig', [
            "users" => $users,
        ]);
    }
    /**
     * @Route("/add-user", name="add_user")
     */
    public function addUser(Request $request): Response
    {
        $datetime = new DateTime();
        $user = new User();
        $user->setCreatedDateUser(new \DateTime());
        $user->setLastUpdatedUser(new \DateTime());
        $form=$this->createForm(UserFormType::class,$user);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirect('user');
        }

        return $this->render("user/_form.html.twig", [
            "form" => $form->createView(),
        ]);
    }
    /**
     * @Route("/modify-user/{id}", name="modify_user")
     */
    public function modifyUser(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager->getRepository(User::class)->find($id);
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            return $this->redirectToRoute('user', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render("user/_form.html.twig", [
            "form_title" => "Modify user",
            "form" => $form->createView(),
        ]);
    }
    /**
     * @Route("/delete-user/{id}", name="delete_user")
     */
    public function deleteUser(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute("user");
    }
}
