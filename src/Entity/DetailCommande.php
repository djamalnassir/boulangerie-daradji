<?php

namespace App\Entity;

use App\Repository\DetailCommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailCommandeRepository::class)
 */
class DetailCommande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $quantite;

    /**
     * @ORM\OneToOne(targetEntity=MatierePremiere::class, mappedBy="detailProduction", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $matierePremiere;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="detailCommandes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $commande;

    /**
     * @ORM\OneToOne(targetEntity=MatierePremiere::class, mappedBy="detailCommande", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $matiereP;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getMatierePremiere(): ?MatierePremiere
    {
        return $this->matierePremiere;
    }

    public function setMatierePremiere(MatierePremiere $matierePremiere): self
    {
        $this->matierePremiere = $matierePremiere;

        return $this;
    }

    public function getMatiereP(): ?MatierePremiere
    {
        return $this->matiereP;
    }

    public function setMatiereP(MatierePremiere $matiereP): self
    {
        $this->matiereP = $matiereP;
        
        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }
}
