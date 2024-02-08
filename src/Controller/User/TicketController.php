<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class TicketController extends AbstractController
{
    #[Route('/ticket', name: 'app_ticket')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->find(1);

        return $this->render('user/ticket/index.html.twig', [
            'controller_name' => 'TicketController',
            'user' => $user, 
        ]);
    }

    #[Route('/create-ticket', name: 'create_ticket')]
    public function create(): Response
    {
        return $this->render('user/ticket/create.html.twig');
    }
}
