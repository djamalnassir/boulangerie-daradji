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
     * @ORM\ManyToOne(targetEntity=MatierePremiere::class, inversedBy="detailCommandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matierePremiere;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="detailCommandes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $commande;

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
