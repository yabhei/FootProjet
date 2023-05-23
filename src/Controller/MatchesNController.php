<?php

namespace App\Controller;

use App\Entity\MatchesN;
use App\Form\MatchesNType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatchesNController extends AbstractController
{
    #[Route('/matches/n', name: 'app_matches')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $matches = $doctrine->getRepository(MatchesN::class) ->findAll();
        return $this->render('matches_n/index.html.twig', [
           'matches'=> $matches
        ]);
    }



    #[Route('/match', name: 'make_match')] // Defines a new route
    #[Route('/match/edit/{id}', name: 'update_match')]
public function CreateMatch(EntityManagerInterface $em, Request $request, MatchesN $match = null): Response // Defines a function with two parameters, the first one is an instance of ManagerRegistry class and the second one is a Request object. It returns a Response object.
{

    // Create a new Matches object
    
if(!$match){
    $match = new MatchesN();
}
    
    // Create a form object using the TeamType class and the $team object
    $form = $this->createForm(MatchesNType::class, $match );

    // Handle the form submission
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) { // If the form is submitted and valid

        // Get the data from the form
        $match = $form->getData();

        // Get the entity manager and persist the match object
        //$entityManager = $doctrine->getManager();
        $em->persist($match);

        // Flush changes to the database
        $em->flush();

        // Redirect to the match page
        return $this->redirectToRoute("app_matches");

    }

        // Render the add match form template
        return $this->render('matches_n/MakeMatch.html.twig', [
            'form' => $form->createView(),
            
        ]);
}



}
