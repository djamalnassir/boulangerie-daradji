<?php

namespace App\Controller;

use App\Entity\Vente;
use App\Form\VenteType;
use App\Entity\ProduitFini;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class VenteController extends AbstractController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("comptable/vente/gerer", name="manage_vente")
     */
    public function manage()
    {

        $ventes = $this->getDoctrine()->getRepository(Vente::class)->findAll();
        
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('comptable/vente/gestion.html.twig', [
            'page_name' => 'Produit Fini',
            'ventes' => $ventes,
            'profile' => $profile,
        ]);
    }

    /**
     * @Route("comptable/vente/ajout", name="add_vente")
     */
    public function add(AuthenticationUtils $authenticationUtils, Request $request)
    {
        $vente = new Vente();
        $form = $this->createForm(VenteType::class, $vente);
        $form->handleRequest($request);
        $user = $this->tokenStorage->getToken()->getUser();

        if($form->isSubmitted() && $form->isValid())
        {

            $date_jour = new \DateTime('now');
            $vente->setDateVente($date_jour);
            $vente->setUser($user);
            $quantite = $form->getData()->getQuantite();
            $libelle = $form->getData()->getProduitFini()->getLibelle();

            $produit =  new ProduitFini();
            $produit = $this->getDoctrine()->getRepository(ProduitFini::class)->findOneByLibelle($libelle);

            $prix = $produit->getPrixUnitaire();

            $total = $quantite * $prix;
            
            $entityManager = $this->getDoctrine()->getManager();
        
            // persistence
            $entityManager->persist($vente);
            
            $entityManager->flush();
            $this->addFlash('success', 'Vente ajouté avec succès!');

            return $this->redirectToRoute('manage_vente');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        

        return $this->render('comptable/vente/ajout.html.twig', [
            'page_name' => 'Produit',
            'form' => $form->createView(),
            'error' => $error,
            'profile' => $profile
        ]);
    }

    
}
