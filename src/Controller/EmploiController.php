<?php

namespace App\Controller;

use App\Forms\FormsType;
use App\Entity\Programmation;
use App\Repository\ClasseetudiantRepository;
use App\Repository\FiliereRepository;
use App\Repository\ProgrammationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/emploi")
 *
 */
class EmploiController extends AbstractController
{
    /**
     * @Route("", name="accueil")
     */
    public function index(): Response
    {

        return $this->render('emploi/index.html.twig');
    }

    /**
     * @Route("/espaceEnsgn", name="EspaceEnseignant")
     * @IsGranted("ROLE_USER")
     */
    public function espaceEnsegnant(): Response
    {
       $session=$this->getUser();
       $role = $session->getRoles()[0];
       //dd($role);
       if ($role == 'ROLE_ADMIN') {
         return  $this->redirectToRoute('app_admin');
       } else {
        return $this->render('emploi/espaceEsgn.html.twig');   
       }
        
    }

    /**
     * @Route("/programmation", name="prog", methods={"POST", "GET"})
     * @IsGranted("ROLE_USER")
     * 
     */
    public function programmation(Request $request, EntityManagerInterface $em): Response
    {
       

        if (!$this->getUser()->isVerified()) {
            
            //throw $this->createAccessDeniedException('');
            $this->addFlash('error', 'You must verify your Email Address before accessing this page!');
            return $this->redirectToRoute('EspaceEnseignant');
        }

        $progr = new Programmation();
        //$form = $this->createFormBuilder()
        $form = $this->createForm(FormsType::class, $progr);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $progr = $form->getData();
            //   //$em= $this->getDoctrine()->getManager();
            $progr->setUser($this->getUser());
            $em->persist($progr);
            $em->flush();
            $this->addFlash('success', 'Cours programmé avec success!');
            return $this->redirectToRoute('paniers');
        }

        return $this->render('emploi/programmation.html.twig', [
            'monFormulaire' => $form->createView()
        ]);
    }

    /**
     * @Route("/paniers_cours", name="paniers")
     * @IsGranted("ROLE_USER")
     */
    public function paniers(ProgrammationRepository $repos): Response
    {
        // ...->paginate(Programmation ::NUM_ITEMS_PER_PAGE);
       

        $loguser =   $this->getUser()->getId();

        $baskets = $repos->findBy(['user' => $loguser], ['createdAt' => 'DESC']);
        return $this->render('emploi/paniers.html.twig', ['monpaniers' => $baskets]);
    }
   
     /**
     * @Route("/paniers_classe", name="classepaniers")
     * @IsGranted("ROLE_USER")
     */
    public function emploidutempsparfiliere(ProgrammationRepository $res): Response
    {
        // ...->paginate(Programmation ::NUM_ITEMS_PER_PAGE);
       

        // $loguser =   $this->getUser()->getId();

        // 
        $baskets = $res->findBy(['classeetudiant' => '1'], [ 'semainedeb' => 'ASC','heuredeb' => 'ASC' ]);
      
        // $baskets = $res->emploi();
        return $this->render('emploi/classepaniers.html.twig', ['paniersclasse' => $baskets]);
    }

    /**
     * @Route("/{id}", name="showdetailprog")
     * @IsGranted("ROLE_USER")
     */
    public function show($id, ProgrammationRepository $rep): Response
    {
        
        $clt = $rep->find($id);
        return $this->render('emploi/showprog.html.twig', ['monpaniers' => $clt]);
    }

    /**
     * @Route("/edit/{id}", name="editprog")
     * @IsGranted("ROLE_USER")
     */
    public function edit($id, Request $request, ProgrammationRepository $val, EntityManagerInterface $em): Response
    {
      
        if (!$this->getUser()->isVerified()) {
            $this->addFlash('error', 'You must verify your Email Address before accessing this page!');
            return $this->redirectToRoute('EspaceEnseignant');
        }

        $v = new  Programmation();
        $v = $val->find($id);

        $form = $this->createForm(FormsType::class, $v);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $v = $form->getData();

            $em->flush();
            $this->addFlash('success', 'Programmation modifié avec success!');
            return $this->redirectToRoute('paniers');
        }


        return $this->render('emploi/editprog.html.twig', ['modifprog' => $form->createview()]);
    }

    /**
     * @Route("/delete/{id}", name="deleteprog")
     * @IsGranted("ROLE_USER")
     */

    public function delete($id, Request $request, ProgrammationRepository $valsup, EntityManagerInterface $em): Response
    {
        

        if (!$this->getUser()->isVerified()) {
            $this->addFlash('error', 'You must verify your Email Address before accessing this page!');
            return $this->redirectToRoute('EspaceEnseignant');
        }

        $v = $valsup->find($id);
        $em->remove($v);
        $em->flush();
        $response = new Response();
        $response->send();
        $this->addFlash('info', 'Programmation supprimée avec success!');
        return $this->redirectToRoute('paniers');
    }

}
