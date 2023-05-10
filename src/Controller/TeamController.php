<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\User;
use App\Form\TeamType;
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
        $teams = $doctrine->getRepository(Team::class) ->findAll();
        
        return $this->render('team/index.html.twig', [
            'teams'=>$teams
        
        ]);
    }

    #[Route('/add', name: 'add_team')]
    public function AddTeam(ManagerRegistry $doctrine, Request $request): Response
    {

        
        $team = new Team();
        $user =$this->getUser();
        $team->setCaptain($user);
        $user->setCaptain(true);
        $form = $this->createForm(TeamType::class, $team );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $team = $form->getData();
            $entityManager = $doctrine->getManager();

            $entityManager->persist($team);
            $entityManager->flush();
            // $this->addFlash($team->getName()." added successfully");
            return $this->redirectToRoute("app_team");
        } else {
            return $this->render('team/add_team.html.twig', [
                'form' => $form->createView(),
                'user' => $this->getUser()
            ]);
        }
        

        // return $this->render('team/add_team.html.twig', [
        //     'form' => $form->createView(),
        // ]);
    }


        #[Route('/team/{id}', name:'details_team')]
    public function  details_Team(Team $team, ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getRepository(User::class) ->findAll();
        
        return $this->render('team/details.html.twig', [
            'team'=>$team,
            'users'=>$users
            
        
        ]);

    }


    #[Route('/team/addplayer/{id}/{id_user}', name:'add_usertoteam')]
    public function  AddUserToTeam($id,$id_user,Team $team, ManagerRegistry $doctrine): Response
    {
        $user = $doctrine->getRepository(User::class) ->find($id_user);
        $one_team = $doctrine->getRepository(Team::class) ->find($id);
        $one_team->addUser($user);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($team);
        $entityManager->flush();

        $users = $doctrine->getRepository(User::class) ->findAll();
        return $this->render('team/details.html.twig', [
            'team'=>$team,
            'users'=>$users
            
            
        
        ]);

    }


    #[Route('/team/remove/{id}/{id_user}', name:'remove_userfromteam')]
    public function  RemoveUserFromTeam($id,$id_user,Team $team, ManagerRegistry $doctrine): Response
    {
        $user = $doctrine->getRepository(User::class) ->find($id_user);
        $one_team = $doctrine->getRepository(Team::class) ->find($id);
        $one_team->removeUser($user);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($team);
        $entityManager->flush();
        
        $users = $doctrine->getRepository(User::class) ->findAll();
        return $this->render('team/details.html.twig', [
            'team'=>$team,
            'users'=>$users
            
            
        
        ]);

    }

}
