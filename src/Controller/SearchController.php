<?php

namespace App\Controller;

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

    #[Route('/search', name:'search')]

    public function search(Request $request)
{
    $form = $this->createForm(SearchFormType::class, null);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Perform the search based on the submitted data
        $searchQuery = $form->get('search')->getData();
        // ... Your search logic here ...
        // Return the search results to the view
        return $this->render('search/results.html.twig', [
            // 'results' => $searchResults
        ]);
    }
    return $this->render('search/index.html.twig', [
        'form' => $form->createView(),
    ]);
}

}
