<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getRepository(User::class) ->findAll();
        
        return $this->render('user/index.html.twig', [
            'users'=>$users
        
        ]);
    }


    #[Route('/user/list', name: 'list_user')]
    public function ListUsers(ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getRepository(User::class) ->findAll();
        
        return $this->render('user/index.html.twig', [
            'users'=>$users
        
        ]);
    }



    // #[Route('/userteam/{id}', name: 'user_team')]
    // public function addUserToTeam(ManagerRegistry $doctrine): Response
    // {
    //     $users = $doctrine->getRepository(User::class) ->findAll();
        
    //     return $this->render('user/usertoadd.html.twig', [
    //         'users'=>$users
        
    //     ]);
    // }


    #[Route('/user_details/{id}', name:'details_user')]
    public function  details_User( User $user): Response
    {
        
        return $this->render('user/detailsUser.html.twig', [
            'user'=>$user,
            
            
        
        ]);

    }

    #[Route('/my_details/{id}', name:'my_details')]
    public function  My_details( User $user): Response
    {
        
        return $this->render('user/My_details.html.twig', [
            'user'=>$user,
            
            
        
        ]);

    }

}
