<?php

namespace App\Controller;

use App\Entity\Programmation;
use App\Entity\User;
use App\Form\ChangePasswordFormType;
use App\Form\ClasseetudiantType;
use App\Form\RegistrationFormType;
use App\Form\UserFormType;
use App\Repository\ClasseetudiantRepository;
use App\Repository\FiliereRepository;
use App\Repository\ProgrammationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Knp\Snappy\Pdf;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */

class AdminController extends AbstractController
{
    /**
     * @Route("", name="app_admin")
     */
    public function index( ProgrammationRepository $res, Request $request, EntityManagerInterface $em ): Response
    {
        $vit = new Programmation;

        $form = $this->createForm(ClasseetudiantType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $progr = $form->getData();
            
            
            if ($form->getData('name') == 'GENIE LOGICIEL LICENCE 1') {
                $baskets = $res->findBy(['classeetudiant' => '1'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 10);

                $basked = $res->findBy(['classeetudiant' => '1'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                    
                 return $this->render('Admin/emploi.html.twig', [ 
                     'paniersclasse' => $baskets, 'call'=> $basked]);

            }

            if ($form->getData('name') == 'GENIE LOGICIEL LICENCE 2') {
                $baskets = $res->findBy(['classeetudiant' => '2'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 10);

                $basked = $res->findBy(['classeetudiant' => '2'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                    
                 return $this->render('Admin/emploi.html.twig', [ 
                     'paniersclasse' => $baskets, 'call'=> $basked]);

            }

             if ($form->getData('name') == 'GENIE LOGICIEL LICENCE 3') {
             $baskets = $res->findBy(['classeetudiant' => '3'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                $basked = $res->findBy(['classeetudiant' => '3'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
              return $this->render('Admin/emploi.html.twig', [ 
             'paniersclasse' => $baskets, 'call'=> $basked]);

            }

            if ($form->getData('name') == 'GENIE LOGICIEL MASTER 1') {
                 $baskets = $res->findBy(['classeetudiant' => '4'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                $basked = $res->findBy(['classeetudiant' => '4'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
             return $this->render('Admin/emploi.html.twig', [ 
                 'paniersclasse' => $baskets, 'call'=> $basked]);

             }

            if ($form->getData('name') == 'GENIE LOGICIEL MASTER 2') {
                $baskets = $res->findBy(['classeetudiant' => '5'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                $basked = $res->findBy(['classeetudiant' => '5'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
              return $this->render('Admin/emploi.html.twig', [ 
                 'paniersclasse' => $baskets, 'call'=> $basked]);

            }

            if ($form->getData('name') == 'SIRI LICENCE 3') {
                $baskets = $res->findBy(['classeetudiant' => '6'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                $basked = $res->findBy(['classeetudiant' => '6'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
             return $this->render('Admin/emploi.html.twig', [ 
                  'paniersclasse' => $baskets, 'call'=> $basked]);

            }

             if ($form->getData('name') == 'SIRI MASTER 1') {
                 $baskets = $res->findBy(['classeetudiant' => '7'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                 $basked = $res->findBy(['classeetudiant' => '7'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
              return $this->render('Admin/emploi.html.twig', [ 
                  'paniersclasse' => $baskets, 'call'=> $basked]);

             }

             if ($form->getData('name') == 'SIRI MASTER 2') {
                $baskets = $res->findBy(['classeetudiant' => '8'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                 $basked = $res->findBy(['classeetudiant' => '8'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
              return $this->render('Admin/emploi.html.twig', [ 
                  'paniersclasse' => $baskets, 'call'=> $basked]);

             }

             if ($form->getData('name') == 'SECURITE INFORMATIQUE LICENCE 1') {
                 $baskets = $res->findBy(['classeetudiant' => '9'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                $basked = $res->findBy(['classeetudiant' => '9'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
              return $this->render('Admin/emploi.html.twig', [ 
                  'paniersclasse' => $baskets, 'call'=> $basked]);

             }

             if ($form->getData('name') == 'SECURITE INFORMATIQUE LICENCE 2') {
                 $baskets = $res->findBy(['classeetudiant' => '10'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                 $basked = $res->findBy(['classeetudiant' => '10'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
              return $this->render('Admin/emploi.html.twig', [ 
                  'paniersclasse' => $baskets, 'call'=> $basked]);

             }

             if ($form->getData('name') == 'SECURITE INFORMATIQUE LICENCE 3') {
                 $baskets = $res->findBy(['classeetudiant' => '11'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                 $basked = $res->findBy(['classeetudiant' => '11'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
              return $this->render('Admin/emploi.html.twig', [ 
                  'paniersclasse' => $baskets, 'call'=> $basked]);

            }

             if ($form->getData('name') == 'SECURITE INFORMATIQUE MASTER 1') {
                 $baskets = $res->findBy(['classeetudiant' => '12'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                 $basked = $res->findBy(['classeetudiant' => '12'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
              return $this->render('Admin/emploi.html.twig', [ 
                 'paniersclasse' => $baskets, 'call'=> $basked]);

             }

             if ($form->getData('name') == 'SECURITE INFORMATIQUE MASTER 2') {
                 $baskets = $res->findBy(['classeetudiant' => '13'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                 $basked = $res->findBy(['classeetudiant' => '13'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
              return $this->render('Admin/emploi.html.twig', [ 
                  'paniersclasse' => $baskets, 'call'=> $basked]);

             }

             if ($form->getData('name') == 'INTERNET ET MULTIMEDIA LICENCE 1') {
                 $baskets = $res->findBy(['classeetudiant' => '14'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                 $basked = $res->findBy(['classeetudiant' => '14'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
              return $this->render('Admin/emploi.html.twig', [ 
                  'paniersclasse' => $baskets, 'call'=> $basked]);

             }

             if ($form->getData('name') == 'INTERNET ET MULTIMEDIA LICENCE 2') {
                 $baskets = $res->findBy(['classeetudiant' => '15'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                 $basked = $res->findBy(['classeetudiant' => '15'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
              return $this->render('Admin/emploi.html.twig', [ 
                  'paniersclasse' => $baskets, 'call'=> $basked]);

             }

             if ($form->getData('name') == 'INTERNET ET MULTIMEDIA LICENCE 3') {
                 $baskets = $res->findBy(['classeetudiant' => '16'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

                 $basked = $res->findBy(['classeetudiant' => '16'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
                
              return $this->render('Admin/emploi.html.twig', [ 
                  'paniersclasse' => $baskets, 'call'=> $basked]);

             }

           
        }

        return $this->render('Admin/index.html.twig', [
            'formulaire' => $form->createView()
        ]);
        
       
    }

     /**
     * @Route("/ad", name="app_adminsave")
     */
    public function savesalle( ProgrammationRepository $res, Request $request, EntityManagerInterface $em): Response
    {
       

        $baskets = $res->findBy(['classeetudiant' => '1'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

        $basked = $res->findBy(['classeetudiant' => '1'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
      
     return $this->render('Admin/index.html.twig', ['paniersclasse' => $baskets, 'call'=> $basked]);

        
        
    }


    /**
     * @Route("/table", name="app_table")
     */
    public function tableuser( UserRepository $user ): Response
    {
        $VarName = $user->findBy([], [ 'createdAt' => 'ASC' ]);
        return $this->render('Admin/table.html.twig', ['utilisateur' => $VarName]);

    }
     /**
     * @Route("/googlemaps", name="app_admin_simple")
     */
    public function googlemaps( ): Response
    {
        return $this->render('Admin/simple.html.twig');

    }

     /**
     * @Route("/credits", name="app_admin_credits")
     */
    public function credits( ): Response
    {
        return $this->render('Admin/credits.html.twig');

    }

     /**
     * @Route("/stats", name="app_stats")
     */
    public function stats(UserRepository $user, ProgrammationRepository $prog, 
    ClasseetudiantRepository $class, FiliereRepository $fil): Response
    {
        
        $Var = $user->findBy(['isVerified' => '1'], [ 'createdAt' => 'ASC' ]);
        $Vart = $prog->findAll();
        $f = $fil->findAll();
        $c = $class->findAll();
        return $this->render('Admin/statistiques.html.twig', ['utilisateur' => $Var,
         'programmation' => $Vart,'classe' => $c, 'filiere' => $f, ]);

    }

     /**
     * @Route("/register", name="app_admin_register", methods={"GET", "POST"})
     */
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher,  EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('plainpassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('noreply@Ifriemploidutemps.com', 'IFRIemploidutemps'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('emails/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email
            $this->addFlash('success', 'User successfully created! Log in now!');
            return $this->redirectToRoute('app_admin_register');
        }

        return $this->render('Admin/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
 
    }

    

     /**
     * @Route("/delete/{id}", name="deleteEnsg")
     * 
     */

    public function delete($id, Request $request, UserRepository $valsup, EntityManagerInterface $em): Response
    {
        

      

        $v = $valsup->find($id);
        $em->remove($v);
        $em->flush();
        $response = new Response();
        $response->send();
        $this->addFlash('info', 'Enseignant(e) supprimé(e) avec success!');
        return $this->redirectToRoute('app_table');
    }

   /**
     * @Route("/accountadmin", name="app_account_admin")
     * 
     */
    public function show(): Response
    {
        return $this->render('Admin/accountadmin/show.html.twig');
    }

    /**
     * @Route("/accounteditadmin", name="app_account_admin_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EntityManagerInterface $em): Response
    {


        $user = $this->getUser();
        $form = $this->createForm(UserFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dd('processing');
            $em->flush();
            $this->addFlash('success', 'Account updated successfully!');
            return $this->redirectToRoute('app_account_admin');
        }

        // if ($this->getUser()) {
        //     return $this->redirectToRoute('app_account_edit');
        //  }
        return $this->render('Admin/accountadmin/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/change-password", name="app_account_admin_change_password",  methods={"GET", "POST"})
     */
    public function changePassword(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordhasher
    ): Response {


        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordFormType::class, null, [
            'current_password_is_required' => true
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dd('processing');
            $user->setPassword(
                $passwordhasher->hashPassword($user, $form['plainpassword']->getData())
            );
            $em->flush();
            $this->addFlash('success', 'Password updated successfully!');
            return $this->redirectToRoute('app_account_admin');
        }

        return $this->render('Admin/accountadmin/change_password.html.twig', [
            'form' => $form->createView()
        ]);
    }



     /**
     * @Route("/emploidutemps", name="pdf_admin")
     */
    // public function emploi(ProgrammationRepository $res): Response
    // {

       
        // $pdfOptions = new Options();
        // $pdfOptions->set('defaultFont', 'Arial');
        
        
        // $dompdf = new Dompdf($pdfOptions);

        // $baskets = $res->findBy(['classeetudiant' => '1'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);

        // $basked = $res->findBy(['classeetudiant' => '1'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ], 1);
        
  
        
        // $html = $this->renderView('Admin/emploidutemps.html.twig', 
        // ['paniersclasse' => $baskets, 'call'=> $basked]);
        
        // $dompdf->loadHtml($html);
        
        // $dompdf->setPaper('A4', 'portrait');

        // $dompdf->render();

        // $dompdf->stream("mypdf.pdf", [
        //     "Attachment" => true
        // ]);

        // return $this->render('emploi/index.html.twig');
        //  }

   
}
