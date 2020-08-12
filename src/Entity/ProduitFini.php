<?php

namespace App\Entity;

use App\Repository\ProduitFiniRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitFiniRepository::class)
 */
class ProduitFini
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="float")
     */
    private $prixUnitaire;

    /**
     * @ORM\OneToOne(targetEntity=DetailProduitFini::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $detailProduitFini;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getDetailProduitFini(): ?DetailProduitFini
    {
        return $this->detailProduitFini;
    }

    public function setDetailProduitFini(DetailProduitFini $detailProduitFini): self
    {
        $this->detailProduitFini = $detailProduitFini;

        return $this;
    }
}
