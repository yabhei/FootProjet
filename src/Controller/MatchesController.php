<?php

namespace App\Controller;

use App\Entity\Matches;
use App\Form\MatchesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatchesController extends AbstractController
{
    #[Route('/matches', name: 'app_matches')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $matches = $doctrine->getRepository(Matches::class) ->findAll();
        return $this->render('matches/index.html.twig', [
           'matches'=> $matches
        ]);
    }



    #[Route('/match', name: 'make_match')] // Defines a new route
public function CreateMatch(ManagerRegistry $doctrine, Request $request): Response // Defines a function with two parameters, the first one is an instance of ManagerRegistry class and the second one is a Request object. It returns a Response object.
{

    // Create a new Matches object
    $match = new Matches();

    
    // Create a form object using the TeamType class and the $team object
    $form = $this->createForm(MatchesType::class, $match );

    // Handle the form submission
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) { // If the form is submitted and valid

        // Get the data from the form
        $match = $form->getData();

        // Get the entity manager and persist the match object
        $entityManager = $doctrine->getManager();
        $entityManager->persist($match);

        // Flush changes to the database
        $entityManager->flush();

        // Redirect to the match page
        return $this->redirectToRoute("app_matches");

    } else { // If the form is not submitted or not valid

        // Render the add match form template
        return $this->render('matches/MakeMatch.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }
}




}



