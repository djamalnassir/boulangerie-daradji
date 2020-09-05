<?php

namespace App\Controller;


use App\Entity\Production;
use App\Entity\ProduitFini;
use App\Entity\DetailProduitFini;
use App\Form\ProduitFiniType;
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
     * @Route("produit/gerer", name="manage_detail_produit")
     */
    public function manage()
    {

        $detail_produits = $this->getDoctrine()->getRepository(ProduitFini::class)->findAll();
        
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        if($profile == "COMPTABLE"){

            return $this->render('produit/gestion-comptable.html.twig', [
                'page_name' => 'Produit Fini',
                'detail_produits' => $detail_produits,
                'profile' => $profile,
            ]);

        }elseif($profile == "GERANT"){

            return $this->render('produit/gestion-gerant.html.twig', [
                'page_name' => 'Produit Fini',
                'detail_produits' => $detail_produits,
                'profile' => $profile,
            ]);
        }
    }

    /**
     * @Route("produit/ajout", name="add_detail_produit")
     */
    public function add(AuthenticationUtils $authenticationUtils, Request $request)
    {
        $produit_fini = new ProduitFini();
        $form = $this->createForm(ProduitFiniType::class, $produit_fini);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {

            $quantite = $form->getData()->getQuantite();
            $entityManager = $this->getDoctrine()->getManager();

            $production = $this->getDoctrine()->getRepository(Production::class)->findOneBy([], ['id' => 'desc']);
            
            $detail_produit = new DetailProduitFini();
            $detail_produit->setProduction($production);
            $detail_produit->setQuantite($quantite);

            // persistence
            $entityManager->persist($produit_fini);

            $detail_produit->setProduitFini($produit_fini);
            $entityManager->persist($detail_produit);
            
            $produit_fini->setDetailProduitFini($detail_produit);
            $entityManager->flush();
            $this->addFlash('success', 'Produit Fini ajouté avec succès!');

            return $this->redirectToRoute('manage_detail_produit');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('produit/ajout.html.twig', [
            'page_name' => 'Produit',
            'form' => $form->createView(),
            'error' => $error,
            'profile' => $profile
        ]);
    }

    
}
