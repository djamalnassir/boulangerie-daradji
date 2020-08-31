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
        return $this->render('home.html.twig', [
            'profile' => $profile,
            'page_name' => 'Chef',
        ]);
    }

    /**
     * @Route("/accueil-comptable", name="home_comptable")
     */
    public function accueilComptable()
    {
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('accueil-comptable.html.twig', [
            'page_name' => 'Comptables',
            'profile' => $profile
        ]);
    }

    /**
     * @Route("/accueil-gerant", name="home_gerant")
     */
    public function accueilGerant()
    {
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();
        
        return $this->render('accueil-gerant.html.twig', [
            'page_name' => 'Gerant',
            'profile' => $profile
        ]);
    }
}
