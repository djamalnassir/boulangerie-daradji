<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
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
    private $date;

    /** 
     * @ORM\OneToMany(targetEntity=DetailCommande::class, mappedBy="commande", orphanRemoval=true)
     */
    private $detailCommande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDetailCommande(): ?DetailCommande
    {
        return $this->detailCommande;
    }

    public function setDetailCommande(DetailCommande $detailCommande): self
    {
        $this->detailCommande = $detailCommande;

        // set the owning side of the relation if necessary
        if ($detailCommande->getCommande() !== $this) {
            $detailCommande->setCommande($this);
        }

        return $this;
    }
}
