<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Date;

class StagiaireController extends AbstractController
{
    #[Route('/stagiaire', name: 'app_stagiaire')]
    #[Route('/stagaire/edit/{id}', name: 'edit')]
    public function index(StagiaireRepository $repo, Request $globals, EntityManagerInterface $manager, Stagiaire $stagiaire = null): Response
    {

        $stagiaires = $repo->findAll();


        if($stagiaire == null) {

            $stagiaire = new Stagiaire;

            

        }
        

        $form = $this->createForm(StagiaireType::class, $stagiaire); 

        $form->handleRequest($globals);

        if($form->isSubmitted() && $form->isValid())
        {
            
            $manager->persist($stagiaire); 
            $manager->flush();  

            return $this->redirectToRoute('app_stagiaire');
            
        } 

        return $this->renderForm('stagiaire/index.html.twig', [
            'formStagiaire' => $form,
            'editMode' => $stagiaire->getId(),
            'stagiaires' => $stagiaires
        ]);
    }

    #[Route('/stagiaire/delete/{id}', name: 'delete')]
    public function delete($id, EntityManagerInterface $manager, StagiaireRepository $repo )
    {
        $stagiaire = $repo->find($id);

        $manager->remove($stagiaire); 
        $manager->flush(); 

        return $this->redirectToRoute('app_stagiaire');  
     
    }
       
        
}
