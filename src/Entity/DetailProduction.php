<?php

namespace App\Entity;

use App\Repository\DetailProductionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailProductionRepository::class)
 */
class DetailProduction
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
     * @ORM\ManyToOne(targetEntity=Production::class, inversedBy="detailProductions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $production;

    /**
     * @ORM\OneToOne(targetEntity=MatierePremiere::class, inversedBy="detailProduction", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $matierePremiere;

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

    public function getProduction(): ?Production
    {
        return $this->production;
    }

    public function setProduction(?Production $production): self
    {
        $this->production = $production;

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
}
