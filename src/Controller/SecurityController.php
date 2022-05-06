<?php

namespace App\Controller;

use App\Form\RegistrationFormType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/registerss", name="apssp_register",  methods={"GET", "POST"})
     */
    // public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em): Response
    // {
      
    // //     $form = $this->createForm( RegistrationFormType ::class);
    // //     $form->handleRequest($request);
    // //     if ($form->isSubmitted() && $form->isValid()){
    // //     //    dd($form->getData());
    // //         $user = $form->getData();
    // //         $plainpassword  = $form['plainpassword']->getData();
    // //         $user->setPassword($passwordHasher->hashPassword($user, $plainpassword));

    // //         $em->persist($user);
    // //         $em->flush();
    // //         $this->addFlash('success', 'User successfully created! Log in now!');
    // //         return $this->redirectToRoute('accueil');
    // //     }
    // //    // dd($form);
    // //     return $this->render('registration/register.html.twig', [
    // //         'registrationForm' => $form->createView()
    // //     ]);
    // }
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
            $this->addFlash('error', 'Already logged in!');
             return $this->redirectToRoute('EspaceEnseignant');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout", methods="POST|GET")
     */
    public function logout()
    {
        // $this->addFlash('success', 'Logged out successfully!');
        // return $this->redirectToRoute('accueil');
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
