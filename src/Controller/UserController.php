<?php

namespace App\Controller;

use App\Entity\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints\DateTime;
/**
 * @Route("/user")
 */
class UserController extends AbstractController
{


    /**
     * @Route("/", name="user")
     */
    public function user()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('user/index.html.twig', [
            "users" => $users,
        ]);
    }
    /**
     * @Route("/show/{id}", name="user_show")
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }
    /**
     * @Route("/add-user", name="add_user")
     */
    public function addUser(Request $request,FlashyNotifier $flashy): Response
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
            $flashy->success('User Added','http://your-awesome-link.com');
            return $this->redirect('user');
        }

        return $this->render("user/_form.html.twig", [
            "form" => $form->createView(),
        ]);
    }
    /**
     * @Route("/modify-user/{id}", name="modify_user")
     */
    public function modifyUser(Request $request, int $id,FlashyNotifier $flashy): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager->getRepository(User::class)->find($id);
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            $flashy->success('User Modified','http://your-awesome-link.com');
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

    /**
     * @Route("/imprimer/pdf", name="imprimer_index")
     */
    public function pdf(UserRepository $userRepository): Response

    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', "Gill Sans MT");

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $user = $userRepository->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('user/pdf.html.twig', [
            'users' =>  $user,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("Liste user.pdf", [
            "Attachment" => true
        ]);

    }
    /**
     * @Route("/statistiques", name="user_statistiques", methods={"GET"})
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

}
