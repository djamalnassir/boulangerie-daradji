<?php

namespace App\Controller;


use App\Entity\Appro;
use App\Entity\Commande;
use App\Entity\DetailAppro;
use App\Entity\MagasinStock;
use App\Form\DetailApproType;
use App\Entity\MatierePremiere;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;




class DetailApproController extends AbstractController
{
    
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/gerant/detail-appro/gerer", name="manage_detail_appro")
     */
    public function manage()
    {

        $detail_appros = $this->getDoctrine()->getRepository(DetailAppro::class)->findAll();
        
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('gerant/detail-appro/gestion.html.twig', [
            'page_name' => 'Approvisionnement',
            'detail_appros' => $detail_appros,
            'profile' => $profile,
        ]);
    }

    /**
     * @Route("/gerant/detail-appro/ajout", name="add_detail_appro")
     */
    public function add(AuthenticationUtils $authenticationUtils, Request $request)
    {
        $detail_appro = new DetailAppro();
        $form = $this->createForm(DetailApproType::class, $detail_appro);
        $form->handleRequest($request);

        // Récuppérer la dernière commande insérée
        $commande = $this->getDoctrine()->getRepository(Commande::class)->findOneBy([], ['id' => 'desc']);

        if($form->isSubmitted() && $form->isValid())
        {
           
            $entityManager = $this->getDoctrine()->getManager();

            // l'utilisateur connecté
            $user = $this->tokenStorage->getToken()->getUser();
            
            // création d'un objet appro et attribution de la date du jour
            $appro = new Appro();
            $date_jour = new \DateTime('now');
            $appro->setDateAppro($date_jour);
            $appro->setCommande($commande);
            $appro->setUser($user);
            
            // persistence
            $entityManager->persist($appro);
            $entityManager->flush();
            
            // mise à jour de l'objet détail commande pour le lier à une commande
            $detail_appro->setAppro($appro);

            $magasin = $this->getDoctrine()->getRepository(MagasinStock::class)->find(14);
            
            $detail_appro->getMatierePremiere()->setMagasinStock($magasin);

            // persistence
            $entityManager->persist($detail_appro);
            $entityManager->flush();
            $this->addFlash('success', 'Appro effectué avec succès!');
            return $this->redirectToRoute('manage_detail_appro');
            
            // flash msg
            $this->add('success', 'Approvisionnement effectué avec succé...');

        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('gerant/detail-appro/ajout.html.twig', [
            'page_name' => 'Approvisionnement',
            'form' => $form->createView(),
            'error' => $error,
            'profile' => $profile
        ]);
    }

    /**
     * @Route("/gerant/detail-appro/supprimer/{id}", name="delete_detail_appro")
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $detail_appro = $entityManager->getRepository(DetailAppro::class)->find($id);
        $detail_appro->getMatierePremiere()->setMagasinStock(null);

        // persistence
        $entityManager->remove($detail_appro);
        $entityManager->flush();

        $this->addFlash('success', 'Suppression réussie!');
        return $this->redirectToRoute("manage_detail_appro");
    }

    /**
     * @Route("/gerant/detail-appro/modifier/{id}", name="modify_detail_appro")
     */
    public function modify(AuthenticationUtils $authenticationUtils, Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $detail_appro = $entityManager->getRepository(DetailAppro::class)->find($id);
        $form = $this->createForm(DetailApproType::class, $detail_appro);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            return $this->redirectToRoute("manage_detail_appro");
        }

        $detail_appros = $this->getDoctrine()->getRepository(DetailAppro::class)->findAll();
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('gerant/detail-appro/modifier.html.twig', [
            'page_name' => 'Appprovisionnement',
            'form' => $form->createView(),
            'profile' => $profile,
            'error' => $error
        ]);
    }

}
