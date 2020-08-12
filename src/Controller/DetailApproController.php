<?php

namespace App\Controller;


use App\Entity\DetailAppro;
use App\Entity\Appro;
use App\Form\DetailApproType;
use App\Entity\MatierePremiere;
use App\Entity\MagasinStock;
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
        
        if($form->isSubmitted() && $form->isValid())
        {

            $entityManager = $this->getDoctrine()->getManager();

            $qte_mp_appro = $form->getData()->getQuantite();
            $mp_cmd = $form->getData()->getMatierePremiere()->getDetailCommande();
            $qte_mp_cmd = $mp_cmd->getQuantite();

            try{

                if ($qte_mp_cmd == $qte_mp_appro) {
                    
                    // création d'un objet appro et attribution de la date du jour
                    $appro = new Appro();
                    $date_jour = new \DateTime('now');
                    $appro->setDateAppro($date_jour);
                    
                    // persistence
                    $entityManager->persist($appro);
                    $entityManager->flush();
                    
                    // mise à jour de l'objet détail commande pour le lier à une commande
                    $detail_appro->setAppro($appro);

                    $magasin = $this->getDoctrine()->getRepository(MagasinStock::class)->find(11);
                    
                    $detail_appro->getMatierePremiere()->setMagasinStock($magasin);
                    // persistence
                    $entityManager->persist($detail_appro);
                    $entityManager->flush();
                    $this->addFlash('success', 'Appro effectué avec succès!');
                    return $this->redirectToRoute('manage_detail_appro');
                }
            
              } catch(\Doctrine\ORM\ORMException $e){

                // flash msg
                $this->add('error', 'Quantite commandée différente de la quantite réçue');

                // error logging - need customization
                $this->get('logger')->error($e->getMessage());

              }
            

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

}
