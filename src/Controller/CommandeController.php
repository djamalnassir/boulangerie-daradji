<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommandeFormType;
use App\Entity\Commande;



class CommandeController extends AbstractController
{
    /**
     * @Route("/commande/gerer", name="manage_commande")
     */
    public function ajout(Request $request)
    {
        $commande = new Commande();
        $form = $this->createForm(CommandeFormType::class, $commande);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commande);
            $entityManager->flush();
            return $this->redirectToRoute('manage_commande');
        }

        $commandes = $this->getDoctrine()->getRepository(Commande::class)->findAll();

        return $this->render('commande/gestion-commande.html.twig', [
            'page_name' => 'Commande',
            'form' => $form->createView(),
            'commandes' => $commandes,
        ]);
    }

    /**
     * @Route("/commande/gerer/{id}", name="delete_commande")
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $commandes = $entityManager->getRepository(Commande::class)->find($id);
        $entityManager->remove($commandes);
        $entityManager->flush();

        return $this->redirectToRoute("manage_commande");
    }

    /**
     * @Route("/commande/modifier/{id}", name="modify_commande")
     */
    public function modify(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $commande = $entityManager->getRepository(Commande::class)->find($id);
        $form = $this->createForm(CommandeFormType::class, $commande);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            return $this->redirectToRoute("manage_commande");
        }

        $commandes = $this->getDoctrine()->getRepository(Commande::class)->findAll();

        return $this->render('commande/modifier.html.twig', [
            'page_name' => 'Commande',
            'form' => $form->createView(),
        ]);
    }
}