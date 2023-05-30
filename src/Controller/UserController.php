<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\Filter;
use App\Form\SearchFormType;
use Doctrine\Persistence\ManagerRegistry;
use Proxies\__CG__\App\Entity\Position;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {

        $filter = new Filter();
        $users = $doctrine->getRepository(User::class) ->findAll();

        $form = $this->createForm(SearchFormType::class, $filter);
        $form->handleRequest($request);

        return $this->render('user/index.html.twig', [
            'users'=>$users,
            'form' => $form->createView(),
            
        
        ]);
    }

    // if ($form->isSubmitted() && $form->isValid()) {
        // $filter = $doctrine->getRepository(Position::class)->SearchPosition();
        // dd($filter);


    // }


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
