<?php

namespace App\Entity;

use App\Repository\MagasinStockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MagasinStockRepository::class)
 */
class MagasinStock
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=MatierePremiere::class, mappedBy="magasinStock")
     */
    private $matierePremieres;

    public function __construct()
    {
        $this->matierePremieres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|MatierePremiere[]
     */
    public function getMatierePremieres(): Collection
    {
        return $this->matierePremieres;
    }

    public function addMatierePremiere(MatierePremiere $matierePremiere): self
    {
        if (!$this->matierePremieres->contains($matierePremiere)) {
            $this->matierePremieres[] = $matierePremiere;
            $matierePremiere->setMagasinStock($this);
        }

        return $this;
    }

    public function removeMatierePremiere(MatierePremiere $matierePremiere): self
    {
        if ($this->matierePremieres->contains($matierePremiere)) {
            $this->matierePremieres->removeElement($matierePremiere);
            // set the owning side to null (unless already changed)
            if ($matierePremiere->getMagasinStock() === $this) {
                $matierePremiere->setMagasinStock(null);
            }
        }

        return $this;
    }
}
