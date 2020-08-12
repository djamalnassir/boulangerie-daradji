<?php

namespace App\Entity;

use App\Repository\ProductionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductionRepository::class)
 */
class Production
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateProduction;

    /**
     * @ORM\OneToMany(targetEntity=DetailProduction::class, mappedBy="production", orphanRemoval=true)
     */
    private $detailProductions;

    /**
     * @ORM\OneToMany(targetEntity=DetailProduitFini::class, mappedBy="production", orphanRemoval=true)
     */
    private $detailProduitFinis;

    public function __construct()
    {
        $this->detailProductions = new ArrayCollection();
        $this->detailProduitFinis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateProduction(): ?\DateTimeInterface
    {
        return $this->dateProduction;
    }

    public function setDateProduction(\DateTimeInterface $dateProduction): self
    {
        $this->dateProduction = $dateProduction;

        return $this;
    }

    /**
     * @return Collection|DetailProduction[]
     */
    public function getDetailProductions(): Collection
    {
        return $this->detailProductions;
    }

    public function addDetailProduction(DetailProduction $detailProduction): self
    {
        if (!$this->detailProductions->contains($detailProduction)) {
            $this->detailProductions[] = $detailProduction;
            $detailProduction->setProduction($this);
        }

        return $this;
    }

    public function removeDetailProduction(DetailProduction $detailProduction): self
    {
        if ($this->detailProductions->contains($detailProduction)) {
            $this->detailProductions->removeElement($detailProduction);
            // set the owning side to null (unless already changed)
            if ($detailProduction->getProduction() === $this) {
                $detailProduction->setProduction(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DetailProduitFini[]
     */
    public function getDetailProduitFinis(): Collection
    {
        return $this->detailProduitFinis;
    }

    public function addDetailProduitFini(DetailProduitFini $detailProduitFini): self
    {
        if (!$this->detailProduitFinis->contains($detailProduitFini)) {
            $this->detailProduitFinis[] = $detailProduitFini;
            $detailProduitFini->setProduction($this);
        }

        return $this;
    }

    public function removeDetailProduitFini(DetailProduitFini $detailProduitFini): self
    {
        if ($this->detailProduitFinis->contains($detailProduitFini)) {
            $this->detailProduitFinis->removeElement($detailProduitFini);
            // set the owning side to null (unless already changed)
            if ($detailProduitFini->getProduction() === $this) {
                $detailProduitFini->setProduction(null);
            }
        }

        return $this;
    }
}
