<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(TokenStorageInterface $tokenStorage)
    {
        $profile = $tokenStorage->getToken()->getUser()->getProfile();
        return $this->render('test.html.twig', [
            'profile' => $profile
        ]);
    }
}
