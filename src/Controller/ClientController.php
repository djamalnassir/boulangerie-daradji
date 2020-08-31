<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ClientType;
use App\Entity\Client;



class ClientController extends AbstractController
{

    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/comptable/client/gerer", name="manage_client")
     */
    public function ajout(Request $request)
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();
            return $this->redirectToRoute('manage_client');
        }

        $clients = $this->getDoctrine()->getRepository(Client::class)->findAll();
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();
        
        return $this->render('comptable/client/gestion.html.twig', [
            'page_name' => 'Client',
            'form' => $form->createView(),
            'clients' => $clients,
            'profile' => $profile
        ]);
    }

    /**
     * @Route("/comptable/client/supprimer/{id}", name="delete_client")
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $client = $entityManager->getRepository(Client::class)->find($id);
        $entityManager->remove($client);
        $entityManager->flush();

        return $this->redirectToRoute("manage_client");
    }

    /**
     * @Route("/comptable/client/modifier/{id}", name="modify_client")
     */
    public function modify(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $client = $entityManager->getRepository(Client::class)->find($id);
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            return $this->redirectToRoute("manage_client");
        }

        $clients = $this->getDoctrine()->getRepository(Client::class)->findAll();
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('comptable/client/modifier.html.twig', [
            'page_name' => 'client',
            'form' => $form->createView(),
            'profile' => $profile
        ]);
    }
}