<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SearchFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(): Response
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }


    #[Route('/search/byPosition', name: 'search_user')]
    public function searchByPosition(ManagerRegistry $doctrine, Request $request): Response
    {
        $form = $this->createForm(SearchFormType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Perform the search based on the submitted data
            $searchQuery = $form->get('position')->getData();
            $posId = $searchQuery->getId();
            $users = $doctrine->getRepository(User::class)->searchByPosition($posId);

            // ->get('position')
            // ... Your search logic here ...
            // Return the search results to the view
            return $this->render('search/results.html.twig', [
                'results' => $users
            ]);
        }
        return $this->render(
            'search/search.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

}