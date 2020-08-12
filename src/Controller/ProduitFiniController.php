<?php

namespace App\Controller;


use App\Entity\Production;
use App\Entity\ProduitFini;
use App\Form\DetailProduitFiniType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DetailProduitFiniController extends AbstractController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/gerant/produit/gerer", name="manage_detail_produit")
     */
    public function manage()
    {

        $detail_produits = $this->getDoctrine()->getRepository(DetailProduitFini::class)->findAll();
        
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('gerant/produit/gestion.html.twig', [
            'page_name' => 'Produit Fini',
            'detail_produits' => $detail_produits,
            'profile' => $profile,
        ]);
    }

    /**
     * @Route("/gerant/produit/ajout", name="add_detail_produit")
     */
    public function add(AuthenticationUtils $authenticationUtils, Request $request)
    {
        $detail_produit = new DetailProduitFini();
        $form = $this->createForm(DetailProduitFiniType::class, $detail_produit);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();

            $id_production = $form->getData()->getProduction()->getId();
            $production = $this->getDoctrine()->getRepository(Production::class)->find($id_production);
        
            $detail_production->setProduction($production);

            // persistence
            $entityManager->persist($detail_produit);
            $entityManager->flush();
            $this->addFlash('success', 'Produit Fini ajouté avec succès!');
            return $this->redirectToRoute('manage_detail_produit');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('gerant/produit/ajout.html.twig', [
            'page_name' => 'Produit',
            'form' => $form->createView(),
            'error' => $error,
            'profile' => $profile
        ]);
    }

    
}
