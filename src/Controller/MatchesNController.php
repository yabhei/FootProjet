<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchesNController extends AbstractController
{
    #[Route('/matches/n', name: 'app_matches_n')]
    public function index(): Response
    {
        return $this->render('matches_n/index.html.twig', [
            'controller_name' => 'MatchesNController',
        ]);
    }
}
