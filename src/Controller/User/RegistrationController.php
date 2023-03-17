<?php

namespace App\Controller\User;

use App\Entity\User\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    public function __construct (
        private UserPasswordHasherInterface $hasher,
        private EntityManagerInterface $entityManager

    )
    {
    }

    public function __invoke (Request $request) {
        $data = json_decode($request->getContent());

        $user = new User();
        $user->patronymic = $data->patronymic;
        $user->setPassword($data->password);

        $hashedPassword = $this->hasher->hashPassword($user, $user->getPassword());

        $user->setPassword($hashedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();


    }

}