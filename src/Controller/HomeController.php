<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/home", name="home")
     */
    public function index(TokenStorageInterface $tokenStorage)
    {
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();
        return $this->render('test.html.twig', [
            'profile' => $profile
        ]);
    }

    /**
     * @Route("/accueil-comptable", name="home_comptable")
     */
    public function accueilComptable()
    {
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('client/accueil.html.twig', [
            'page_name' => 'Client',
            'profile' => $profile
        ]);
    }

    /**
     * @Route("/accueil-gerant", name="home_gerant")
     */
    public function accueilGerant()
    {
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();
        
        return $this->render('gerant/accueil.html.twig', [
            'page_name' => 'Client',
            'profile' => $profile
        ]);
    }
}
