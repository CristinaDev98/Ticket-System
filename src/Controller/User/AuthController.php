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
    #[Route('/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $user = new User();
        $user->setUsername($request->request->get('username'));

        $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));

        $user->setRole('utilizzatore');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('home');
    }

    #[Route('/login', name: 'login')]
    public function login(Request $request): Response
    {
        // Logica di autenticazione dell'utente
        // ...

        // Esempio di redirect dopo il login
        return $this->redirectToRoute('home');
    }
}
