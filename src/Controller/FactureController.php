<?php

namespace App\Controller;

use Dompdf\Dompdf;
use App\Entity\Vente;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FactureController extends AbstractController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }


    /**
     * @Route("comptable/facture/ajouter/{id}", name="generate_facture")
     */
    public function generate_facture(AuthenticationUtils $authenticationUtils, Request $request, int $id)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $vente = $entityManager->getRepository(Vente::class)->find($id);

        $user = $this->tokenStorage->getToken()->getUser();

        /*

            $dompdf = new Dompdf($vente);

            $nom = $vente->getClient()->getNom();
            $telephone = $vente->getClient()->getTelephone();
            $email = $vente->getClient()->getEmail();

            $data = array(
                'headline' => 'my headline'
            );

            $html = $this->renderView('comptable/facture/facture.html.twig', [
                'headline' => "Test pdf generator",
                ''
            ]);
        
    
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream("testpdf.pdf", [
                "Attachment" => true
            ]);
        */

        return $this->render('comptable/facture/facture.html.twig', [
            'vente' => $vente
        ]);

    }

    
}
