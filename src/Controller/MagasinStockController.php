<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MagasinFormType;
use App\Entity\MagasinStock;



class MagasinStockController extends AbstractController
{

    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/magasin/accueil", name="home_gerant")
     */
    public function accueil()
    {
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();
        
        return $this->render('magasin-stock/accueil.html.twig', [
            'page_name' => 'Magasin Stock',
            'profile' => $profile
        ]);
    }

    /**
     * @Route("/magasin/gerer", name="manage_magasin")
     */
    public function ajout(Request $request)
    {
        $magasinStock = new MagasinStock();
        $form = $this->createForm(MagasinFormType::class, $magasinStock );
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($magasinStock);
            $entityManager->flush();
            return $this->redirectToRoute('manage_magasin');
        }

        $magasins = $this->getDoctrine()->getRepository(MagasinStock::class)->findAll();
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();
        
        return $this->render('magasin-stock/gestion-magasin.html.twig', [
            'page_name' => 'Magasin Stock',
            'form' => $form->createView(),
            'magasins' => $magasins,
            'profile' => $profile
        ]);
    }

    /**
     * @Route("/magasin/gerer/{id}", name="delete_magasin")
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $magasins = $entityManager->getRepository(MagasinStock::class)->find($id);
        $entityManager->remove($magasins);
        $entityManager->flush();

        return $this->redirectToRoute("manage_magasin");
    }

    /**
     * @Route("/magasin/modifier/{id}", name="modify_magasin")
     */
    public function modify(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $magasin = $entityManager->getRepository(MagasinStock::class)->find($id);
        $form = $this->createForm(MagasinFormType::class, $magasin);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            return $this->redirectToRoute("manage_magasin");
        }

        $magasins = $this->getDoctrine()->getRepository(MagasinStock::class)->findAll();
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('magasin-stock/modifier.html.twig', [
            'page_name' => 'Magasin Stock',
            'form' => $form->createView(),
            'profile' => $profile
        ]);
    }
}