<?php

namespace App\Entity;

use App\Repository\DetailApproRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailApproRepository::class)
 */
class DetailAppro
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
     * @ORM\ManyToOne(targetEntity=Appro::class, inversedBy="detailAppros")
     * @ORM\JoinColumn(nullable=false)
     */
    private $appro;

    /**
     * @ORM\OneToOne(targetEntity=MatierePremiere::class, inversedBy="detailAppro", cascade={"persist", "remove"})
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

    public function getAppro(): ?Appro
    {
        return $this->appro;
    }

    public function setAppro(?Appro $appro): self
    {
        $this->appro = $appro;

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
