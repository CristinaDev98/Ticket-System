<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ticket;

class TicketController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/ticket', name: 'app_admin_ticket')]
    public function index(): Response
    {
        return $this->render('admin/ticket/index.html.twig', [
            'controller_name' => 'TicketController',
        ]);
    }
    #[Route('admin/ticket/view-ticket', name: 'view_admin_ticket')]
    public function view(): Response
    {
        $ticketRepository = $this->entityManager->getRepository(Ticket::class);
        $tickets = $ticketRepository->findAll();

        return $this->render('admin/ticket/view.html.twig', [
            'tickets' => $tickets,
        ]);
    }

    #[Route('/admin/ticket/update-ticket/{id}', name: 'update_admin_ticket')]
    public function update(int $id, Request $request): Response
    {
        $ticketRepository = $this->entityManager->getRepository(Ticket::class);
        $ticket = $ticketRepository->find($id);

        if (!$ticket) {
            throw $this->createNotFoundException('Ticket non trovato con ID: ' . $id);
        }

        if ($request->isMethod('POST')) {
            $ticket->setMessage($request->request->get('message'));
    
            $this->entityManager->flush();
    
            $this->addFlash('success', 'Ticket aggiornato con successo!');
    
            return $this->redirectToRoute('app_admin_ticket');
        }
    
        return $this->render('admin/ticket/update.html.twig', [
            'ticket' => $ticket,
        ]);
    }
    #[Route('/delete-ticket/{id}', name: 'delete_admin_ticket')]
    public function delete(int $id): Response
    {
        $ticketRepository = $this->entityManager->getRepository(Ticket::class);
        $ticket = $ticketRepository->find($id);

        if (!$ticket) {
            throw $this->createNotFoundException('Ticket non trovato con ID: ' . $id);
        }

        $this->entityManager->remove($ticket);
        $this->entityManager->flush();

        $this->addFlash('success', 'Ticket eliminato con successo!');

        return $this->redirectToRoute('app_admin_ticket');
    }
}
