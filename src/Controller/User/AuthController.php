<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class AuthController extends AbstractController
{
    #[Route('/user/auth', name: 'app_user_auth')]
    public function index(): Response
    {
        return $this->render('user/auth/index.html.twig', [
            'controller_name' => 'AuthController',
        ]);
    }
    // #[Route('/register', name: 'register')]
    // public function register(Request $request, UserPasswordHasherInterface $passwordEncoder): Response
    // {
    //     //
    //     return $this->redirectToRoute('home');
    // }

    //#[Route('/login', name: 'login')]
    // public function login(Request $request): Response
    // {
    //     //
    //     return $this->redirectToRoute('home');
    // }
}
