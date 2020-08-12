<?php

namespace App\Entity;

use App\Repository\DetailProduitFiniRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailProduitFiniRepository::class)
 */
class DetailProduitFini
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Production::class, inversedBy="detailProduitFinis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $production;

    /**
     * @ORM\OneToOne(targetEntity=ProduitFini::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $produitFini;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
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

    public function getProduitFini(): ?ProduitFini
    {
        return $this->produitFini;
    }

    public function setProduitFini(ProduitFini $produitFini): self
    {
        $this->produitFini = $produitFini;

        return $this;
    }
}
