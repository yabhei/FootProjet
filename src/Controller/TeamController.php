<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\User;
use App\Form\TeamType;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeamController extends AbstractController
{
    #[Route('/team', name: 'app_team')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $teams = $doctrine->getRepository(Team::class)->findAll();


        return $this->render('team/index.html.twig', [
            'teams' => $teams

        ]);
    }



    #[Route('/add', name: 'add_team')] // Defines a new route
    public function AddTeam(ManagerRegistry $doctrine, Request $request): Response // Defines a function with two parameters, the first one is an instance of ManagerRegistry class and the second one is a Request object. It returns a Response object.
    {

        // Create a new Team object
        $team = new Team();

        // Set the current user as the captain of the team
        $user = $this->getUser();
        $team->setCaptain($user);
        $team->addUser($user);
        $user->setCaptain(true);

        // Create a form object using the TeamType class and the $team object
        $form = $this->createForm(TeamType::class, $team);

        // Handle the form submission
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { // If the form is submitted and valid

            // Get the data from the form
            $team = $form->getData();

            // Get the entity manager and persist the team object
            $entityManager = $doctrine->getManager();
            $entityManager->persist($team);

            // Flush changes to the database
            $entityManager->flush();

            // Redirect to the team page
            return $this->redirectToRoute("app_team");

        } else { // If the form is not submitted or not valid

            // Render the add team form template
            return $this->render('team/add_team.html.twig', [
                'form' => $form->createView(),
                'user' => $this->getUser()
            ]);
        }
    }


    #[Route('/remove/{id}', name: 'remove_team')] // Defines a new route
    public function RemoveTeam($id, ManagerRegistry $doctrine, Request $request, TeamRepository $teamRepository, EntityManagerInterface $entitymanager): Response // Defines a function with two parameters, the first one is an instance of ManagerRegistry class and the second one is a Request object. It returns a Response object.
    {

        $team = $doctrine->getRepository(Team::class)->find($id);
        dump($team);
        $team->getUsers()->clear();
        $entitymanager->persist($team);
        $entitymanager->remove($team);
        $entitymanager->flush();


        // Redirect to the team page
        return $this->redirectToRoute("app_team");


        // Render the add team form template
        // return $this->render('team/add_team.html.twig', [
        //     'form' => $form->createView(),
        //     'user' => $this->getUser()
        // ]);

    }


    #[Route('/team/{id}', name: 'details_team')]
    public function details_Team(Team $team, ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getRepository(User::class)->findAll();

        return $this->render('team/details.html.twig', [
            'team' => $team,
            'users' => $users


        ]);

    }


    #[Route('/team/addplayer/{id}/{id_user}', name: 'add_usertoteam')]
    public function AddUserToTeam($id, $id_user, Team $team, ManagerRegistry $doctrine, EntityManagerInterface $entitymanager): Response
    {
        $user = $doctrine->getRepository(User::class)->find($id_user);
        $one_team = $doctrine->getRepository(Team::class)->find($id);
        // $test = $entitymanager->getRepository(Team::class)->remove($one_team);
        $one_team->addUser($user);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($team);
        $entityManager->flush();

        $users = $doctrine->getRepository(User::class)->findAll();
        return $this->render('team/details.html.twig', [
            'team' => $team,
            'users' => $users



        ]);

    }


    #[Route('/team/remove/{id}/{id_user}', name: 'remove_userfromteam')]
    public function RemoveUserFromTeam($id, $id_user, Team $team, ManagerRegistry $doctrine): Response
    {
        $user = $doctrine->getRepository(User::class)->find($id_user);
        $one_team = $doctrine->getRepository(Team::class)->find($id);
        $one_team->removeUser($user);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($team);
        $entityManager->flush();

        $users = $doctrine->getRepository(User::class)->findAll();
        return $this->render('team/details.html.twig', [
            'team' => $team,
            'users' => $users



        ]);

    }




}