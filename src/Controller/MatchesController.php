<?php

namespace App\Controller;

use App\Entity\Matches;
use App\Form\MatchesType;
use Doctrine\ORM\EntityManagerInterface;
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
    #[Route('/match/edit/{id}', name: 'update_match')]
public function CreateMatch(EntityManagerInterface $em, Request $request, Matches $match = null): Response // Defines a function with two parameters, the first one is an instance of ManagerRegistry class and the second one is a Request object. It returns a Response object.
{

    // Create a new Matches object
    
if(!$match){
    $match = new Matches();
}
    
    // Create a form object using the TeamType class and the $team object
    $form = $this->createForm(MatchesType::class, $match );

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
        return $this->render('matches/MakeMatch.html.twig', [
            'form' => $form->createView(),
            
        ]);
}



// #[Route('/match/edit/{id}', name: 'update_match')]
// public function UpdateResult(ManagerRegistry $doctrine, Request $request, $id): Response
// {
//     $entityManager = $doctrine->getManager();
//     $match = $doctrine->getRepository(Matches::class)->find($id);

//     if (!$match) {
//         throw $this->createNotFoundException('Entity not found');
//     }

//     $form = $this->createForm(MatchesType::class, $match);
//     $form->handleRequest($request);

//     if ($form->isSubmitted() && $form->isValid()) {
//         // Update the entity with new values

//         $match = $form->getData();
//         $entityManager->flush();
//         return $this->redirectToRoute("app_matches");
//         // return new Response('Entity updated successfully');
//     }

//     $matches = $entityManager->getRepository(Matches::class)->findAll();

//     return $this->render('matches/index.html.twig', [
//         'matches' => $matches
//     ]);
// }




}



