<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
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
     * @ORM\OneToOne(targetEntity=MatierePremiereCommande::class, mappedBy="commande", cascade={"persist", "remove"})
     */
    private $matierePremiereCommande;

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

    public function getMatierePremiereCommande(): ?MatierePremiereCommande
    {
        return $this->matierePremiereCommande;
    }

    public function setMatierePremiereCommande(MatierePremiereCommande $matierePremiereCommande): self
    {
        $this->matierePremiereCommande = $matierePremiereCommande;

        // set the owning side of the relation if necessary
        if ($matierePremiereCommande->getCommande() !== $this) {
            $matierePremiereCommande->setCommande($this);
        }

        return $this;
    }
}
