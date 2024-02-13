<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{

    #[Route('/auth/login', name: 'app_auth_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        
        $error = $authenticationUtils->getLastAuthenticationError();
        $username = $authenticationUtils->getLastUsername();
        


        $user = $this->getUser();

        if ($user) {
            if (in_array('utilizzatore', $user->getRoles())) {
                return $this->redirectToRoute('app_ticket');
            } else {
                return $this->redirectToRoute('app_admin_ticket');
            }
        }

        // Se l'utente non è autenticato, mostra il form di login
        return $this->render('auth/login/login.html.twig', [
            'username' => $username,
            'error'         => $error,
        ]);
    }
}
