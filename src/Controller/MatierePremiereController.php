<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MatierePremiereFormType;
use App\Entity\MatierePremiere;
use App\Entity\MagasinStock;



class MatierePremiereController extends AbstractController
{

    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/matiere/gerer", name="manage_matiere")
     */
    public function manage()
    {

        $matieres = $this->getDoctrine()->getRepository(MatierePremiere::class)->findAll();
        
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('matiere-premiere/gestion.html.twig', [
            'page_name' => 'Matiere Premiere',
            'matieres' => $matieres,
            'profile' => $profile,
        ]);
    }

    /**
     * @Route("/matiere/ajouter", name="add_matiere")
     */
    public function ajout(Request $request, AuthenticationUtils $authenticationUtils)
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
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('matiere-premiere/ajout.html.twig', [
            'page_name' => 'Matiere Premiere',
            'form' => $form->createView(),
            'matieres' => $matieres,
            'profile' => $profile,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/matiere/supprimer/{id}", name="delete_matiere")
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
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('matiere-premiere/modifier.html.twig', [
            'page_name' => 'Matiere Premiere',
            'form' => $form->createView(),
            'profile' => $profile
        ]);
    }
}