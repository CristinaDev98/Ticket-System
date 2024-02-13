<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class UserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/create-admin', name: 'app_admin_create_admin')]
    public function createAdmin(UserPasswordEncoderInterface $passwordEncoder): Response
    {
        
        $existingAdmin = $this->entityManager->getRepository(User::class)->findOneBy(['role' => 'amministratore']);
        if ($existingAdmin) {
            return new Response('An admin user already exists.');
        }

        
        $admin = new User();
        $admin->setUsername('Admin'); 
        $admin->setPassword('PassAdmin'); 
        $admin->setRole('amministratore'); 

        
        $hashedPassword = $passwordEncoder->encodePassword($admin, $admin->getPassword());
        $admin->setPassword($hashedPassword);

     
        $this->entityManager->persist($admin);
        $this->entityManager->flush();

        return new Response('Admin user created successfully!');
    }
}
