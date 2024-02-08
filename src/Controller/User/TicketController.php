<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ticket;
use App\Entity\User;

class TicketController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/ticket', name: 'app_ticket')]
    public function index(): Response
    {
        return $this->render('user/ticket/index.html.twig', [
            'controller_name' => 'TicketController',
        ]);
    }

    #[Route('/create-ticket', name: 'create_ticket')]
    public function create(): Response
    {
        return $this->render('user/ticket/create.html.twig');
    }

    #[Route('/store-ticket', name: 'store_ticket')]
    public function store(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $userRepository = $this->entityManager->getRepository(User::class);
            $user = $userRepository->find(1);
    
            $ticket = new Ticket();
    
            $ticket->setUser($user);
    
            // Ottieni il messaggio 
            $message = $request->request->get('message');
    
            // Verifica se il messaggio è stato fornito
            if ($message === null) {
                throw $this->createNotFoundException('Il campo messaggio è obbligatorio.');
            }
    
            // Imposta il messaggio
            $ticket->setMessage($message);
    
            // Imposta data
            $now = new \DateTimeImmutable();
            $ticket->setCreatedAt($now);
            $ticket->setUpdatedAt($now);
    
            // Salva ticket nel db
            $this->entityManager->persist($ticket);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_ticket');
    }
}
