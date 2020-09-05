<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VenteRepository::class)
 */
class Vente
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
    private $dateVente;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="ventes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ventes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=ProduitFini::class, inversedBy="ventes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produitFini;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateVente(): ?\DateTimeInterface
    {
        return $this->dateVente;
    }

    public function setDateVente(\DateTimeInterface $dateVente): self
    {
        $this->dateVente = $dateVente;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
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

    public function getProduitFini(): ?ProduitFini
    {
        return $this->produitFini;
    }

    public function setProduitFini(?ProduitFini $produitFini): self
    {
        $this->produitFini = $produitFini;

        return $this;
    }
}
