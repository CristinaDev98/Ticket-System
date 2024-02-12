<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    #[Route('/admin/ticket', name: 'app_admin_ticket')]
    public function index(): Response
    {
        return $this->render('admin/ticket/index.html.twig', [
            'controller_name' => 'TicketController',
        ]);
    }
}
