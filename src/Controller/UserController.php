<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\Filter;
use App\Entity\Position;
use App\Form\SearchFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{

    // private $entityManager;

    // public function __construct(EntityManagerInterface $entityManager)
    // {
    //     $this->entityManager = $entityManager;
    // }

    #[Route('/user', name: 'app_user')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        //     $entityManager = $doctrine->getManager();
        //     $positions = $entityManager->getRepository(Position::class)->findAll();
        //     $players = [];

        //     $positionChoices = [];
        //     foreach ($positions as $position) {
        //         $positionChoices[$position->getTitle()] = $position;
        //     }

        //     $searchForm = $this->createForm(SearchType::class, null, [
        //         'positions' => $positions,
        //     ]);
        //     $searchForm->get('position')->setChoices($positionChoices);

        //     $searchForm->handleRequest($request);

        //     if ($searchForm->isSubmitted() && $searchForm->isValid()) {
        //         $position = $searchForm->getData()['position'];
        //         $players = $entityManager->getRepository(User::class)->findBy(['position' => $position]);
        //     } else {
        //         $players = $entityManager->getRepository(User::class)->findAll();
        //     }

        //     return $this->render('user/index.html.twig', [
        //         'searchForm' => $searchForm->createView(),
        //         'players' => $players,
        //     ]);
        // }


        // ...



        // ...


        // $filter = new Filter();
        $users = $doctrine->getRepository(User::class)->findAll();
        $positions = $doctrine->getRepository(Position::class)->findAll();
        // $form = $this->createForm(SearchFormType::class, $filter);
        // $form->handleRequest($request);

        return $this->render('user/index.html.twig', [
            'users' => $users,
            'positions' => $positions,
            // 'form' => $form->createView(),


        ]);


        // if ($form->isSubmitted() && $form->isValid()) {
        //     $filter = $doctrine->getRepository(Position::class)->SearchPosition();
        //     dd($filter);


        // }
    }

    #[Route('/user/list', name: 'list_user')]
    public function ListUsers(ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getRepository(User::class)->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users

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


    #[Route('/user_details/{id}', name: 'details_user')]
    public function details_User(User $user): Response
    {

        return $this->render('user/detailsUser.html.twig', [
            'user' => $user,



        ]);

    }

    #[Route('/my_details/{id}', name: 'my_details')]
    public function My_details(User $user): Response
    {

        return $this->render('user/My_details.html.twig', [
            'user' => $user,



        ]);

    }


    // public function search(Request $request)
    // {
    //     $form = $this->createForm(SearchType::class);
    //     $form->handleRequest($request);

    //     // Fetch all players initially
    //     $players = $this->getDoctrine()->getRepository(User::class)->findAll();

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $position = $form->getData()['position'];
    //         // Fetch players based on the selected position
    //         $players = $this->getDoctrine()->getRepository(User::class)->findBy(['position' => $position]);
    //     }

    //     return new JsonResponse(['players' => $players]);
    // }

}