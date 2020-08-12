<?php

namespace App\Controller;


use App\Entity\Production;
use App\Entity\DetailProduction;
use App\Form\DetailProductionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DetailProductionController extends AbstractController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/gerant/production/gerer", name="manage_detail_production")
     */
    public function manage()
    {

        $detail_productions = $this->getDoctrine()->getRepository(DetailProduction::class)->findAll();
        
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('gerant/production/gestion.html.twig', [
            'page_name' => 'Production',
            'detail_productions' => $detail_productions,
            'profile' => $profile,
        ]);
    }

    /**
     * @Route("/gerant/production/ajout", name="add_detail_production")
     */
    public function add(AuthenticationUtils $authenticationUtils, Request $request)
    {
        $detail_production = new DetailProduction();
        $form = $this->createForm(DetailProductionType::class, $detail_production);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $production = null;

            if($form->getData()->getMatierePremiere()->getMagasinStock() != null){

                $this->addFlash('danger', 'Matiere premiere en rupture de stock!');
                return $this->redirectToRoute('add_detail_production');
            }
            
            if($form->getData()->getProduction() != null){

                $id_production = $form->getData()->getProduction()->getId();
                $production = $this->getDoctrine()->getRepository(Production::class)->find($id_production);
            }
                
             
             
            // création d'un objet commande et attribution de la date du jour
            if($production == null){

                $new_production = new Production();
                $date_jour = new \DateTime('now');
                $new_production->setDateProduction($date_jour);
                // persistence
                $entityManager->persist($new_production);
                $entityManager->flush();

                // mise à jour de l'objet détail commande pour le lier à une commande
                $detail_production->setProduction($new_production);
            }else{

                // mise à jour de l'objet détail commande pour le lier à une commande
                $detail_production->setProduction($production);
            }

            // persistence
            $entityManager->persist($detail_production);
            $entityManager->flush();
            $this->addFlash('success', 'Production ajoutée avec succès!');
            return $this->redirectToRoute('manage_detail_production');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('gerant/production/ajout.html.twig', [
            'page_name' => 'Production',
            'form' => $form->createView(),
            'error' => $error,
            'profile' => $profile
        ]);
    }
}
