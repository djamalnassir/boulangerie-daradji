<?php

namespace App\Controller;


use App\Entity\Commande;
use App\Form\DetailCommandeFormType;
use App\Entity\DetailCommande;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;




class DetailCommandeController extends AbstractController
{
    
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/gerant/detail-commande/gerer", name="manage_detail_commande")
     */
    public function manage()
    {

        $detail_commandes = $this->getDoctrine()->getRepository(DetailCommande::class)->findAll();
        
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('gerant/detail-commande/gestion.html.twig', [
            'page_name' => 'Commandes',
            'detail_commandes' => $detail_commandes,
            'profile' => $profile,
        ]);
    }

    /**
     * @Route("/gerant/detail-commande/ajout", name="add_detail_commande")
     */
    public function add(AuthenticationUtils $authenticationUtils, Request $request)
    {
        $matiere_premiere_commande = new DetailCommande();
        $form = $this->createForm(DetailCommandeFormType::class, $matiere_premiere_commande);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {

            $entityManager = $this->getDoctrine()->getManager();
            $commande = null;
            
            if($form->getData()->getCommande() != null){

                $id_commande = $form->getData()->getCommande()->getId();
                $commande = $this->getDoctrine()->getRepository(Commande::class)->find($id_commande);
            }

            // création d'un objet commande et attribution de la date du jour
            if($commande == null){

                $new_commande = new Commande();
                $date_jour = new \DateTime('now');
                $new_commande->setDate($date_jour);
                // persistence
                $entityManager->persist($new_commande);
                $entityManager->flush();

                // mise à jour de l'objet détail commande pour le lier à une commande
                $matiere_premiere_commande->setCommande($new_commande);
            }else{

                // mise à jour de l'objet détail commande pour le lier à une commande
                $matiere_premiere_commande->setCommande($commande);
            }

            // persistence
            $entityManager->persist($matiere_premiere_commande);
            $entityManager->flush();
            $this->addFlash('success', 'Commande ajoutée avec succès!');
            return $this->redirectToRoute('manage_detail_commande');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('gerant/detail-commande/ajout.html.twig', [
            'page_name' => 'Commandes',
            'form' => $form->createView(),
            'error' => $error,
            'profile' => $profile
        ]);
    }

    /**
     * @Route("/gerant/detail-commande/supprimer/{id}", name="delete_detail_commande")
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $detail_commande = $entityManager->getRepository(DetailCommande::class)->find($id);

        // on réccupère l'id de la commande à laquelle est relié le detail_matiere_premiere
        $id_commande = $detail_commande->getId();

        // persistence
        $entityManager->remove($detail_commande);
        $entityManager->flush();

        // on réccupère le reste des detail_matiere_premiere liés à l'id de la commande
        $details = $entityManager->getRepository(DetailCommande::class)->findByCommandeId($id);

        if($details == null){

            $commande = $entityManager->getRepository(Commande::class)->find($id);
            $entityManager->remove($detail_commande);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Suppression réussie!');
        return $this->redirectToRoute("manage_detail_commande");
    }

    /**
     * @Route("/gerant/detail-commande/modifier/{id}", name="modify_detail_commande")
     */
    public function modify(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $matiere_premiere_commande = $entityManager->getRepository(DetailCommande::class)->find($id);
        $form = $this->createForm(DetailCommandeFormType::class, $matiere_premiere_commande);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            $this->addFlash('success', 'Commande modifiée avec succès');
            return $this->redirectToRoute("manage_detail_commande");
        }

        // $commandes = $this->getDoctrine()->getRepository(MatierePremiereCommande::class)->findAll();
        $profile = $this->tokenStorage->getToken()->getUser()->getProfile();

        return $this->render('gerant/detail-commande/modifier.html.twig', [
            'page_name' => 'Commandes',
            'form' => $form->createView(),
            'profile' => $profile
        ]);
    }
}
