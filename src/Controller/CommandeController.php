<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MagasinFormType;
use App\Entity\Commande;



class CommandeController extends AbstractController
{

    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/commande/gerer", name="manage_commande")
     */
    public function manage()
    {

        $commandes = $this->getDoctrine()->getRepository(Commande::class)->findAll();
        
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('commande/gestion-commande.html.twig', [
            'page_name' => 'Commandes',
            'commandes' => $commandes,
            'profile' => $profile,
        ]);
    }

}