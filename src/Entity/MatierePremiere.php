<?php

namespace App\Entity;

use App\Repository\MatierePremiereRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatierePremiereRepository::class)
 */
class MatierePremiere
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
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=MagasinStock::class, inversedBy="matierePremieres")
     * @ORM\JoinColumn(nullable=true)
     */
    private $magasinStock;

    /**
     * @ORM\OneToMany(targetEntity=DetailCommande::class, mappedBy="matierePremiere")
     */
    private $detailCommande;

    /**
     * @ORM\OneToMany(targetEntity=DetailAppro::class, mappedBy="matierePremiere")
     */
    private $detailAppro;

    /**
     * @ORM\OneToOne(targetEntity=DetailProduction::class, mappedBy="matierePremiere", cascade={"persist", "remove"})
     */
    private $detailProduction;

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMagasinStock(): ?MagasinStock
    {
        return $this->magasinStock;
    }

    public function setMagasinStock(?MagasinStock $magasinStock): self
    {
        $this->magasinStock = $magasinStock;

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
        if ($detailCommande->getMatierePremiere() !== $this) {
            $detailCommande->setMatierePremiere($this);
        }

        return $this;
    }

    public function getDetailAppro(): ?DetailAppro
    {
        return $this->detailAppro;
    }

    public function setDetailAppro(DetailAppro $detailAppro): self
    {
        $this->detailAppro = $detailAppro;

        // set the owning side of the relation if necessary
        if ($detailAppro->getMatierePremiere() !== $this) {
            $detailAppro->setMatierePremiere($this);
        }

        return $this;
    }

    public function getDetailProduction(): ?DetailProduction
    {
        return $this->detailProduction;
    }

    public function setDetailProduction(DetailProduction $detailProduction): self
    {
        $this->detailProduction = $detailProduction;

        // set the owning side of the relation if necessary
        if ($detailProduction->getMatierePremiere() !== $this) {
            $detailProduction->setMatierePremiere($this);
        }

        return $this;
    }
}
