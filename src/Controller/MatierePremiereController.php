<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MatierePremiereFormType;
use App\Entity\MatierePremiere;
use App\Entity\MagasinStock;



class MatierePremiereController extends AbstractController
{
    /**
     * @Route("/matiere/gerer", name="add_matiere")
     */
    public function ajout(Request $request)
    {
        $matiere = new MatierePremiere();
        $form = $this->createForm(MatierePremiereFormType::class, $matiere);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($matiere);
            $entityManager->flush();
            return $this->redirectToRoute('manage_matiere');
        }

        $matieres = $this->getDoctrine()->getRepository(MatierePremiere::class)->findAll();

        return $this->render('matiere-premiere/gestion-commande.html.twig', [
            'page_name' => 'Matiere Premiere',
            'form' => $form->createView(),
            'matieres' => $matieres,
        ]);
    }

    /**
     * @Route("/matiere/gerer/{id}", name="delete_matiere")
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $matieres = $entityManager->getRepository(MatierePremiere::class)->find($id);
        $entityManager->remove($matieres);
        $entityManager->flush();

        return $this->redirectToRoute("manage_matiere");
    }

    /**
     * @Route("/matiere/modifier/{id}", name="modify_matiere")
     */
    public function modify(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $matiere = $entityManager->getRepository(MatierePremiere::class)->find($id);
        $form = $this->createForm(MatierePremiereFormType::class, $matiere);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            return $this->redirectToRoute("manage_matiere");
        }

        $matieres = $this->getDoctrine()->getRepository(MatierePremiere::class)->findAll();

        return $this->render('matiere/modifier.html.twig', [
            'page_name' => 'Matiere Premiere',
            'form' => $form->createView(),
        ]);
    }
}