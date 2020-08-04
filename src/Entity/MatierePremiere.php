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
     * @ORM\JoinColumn(nullable=false)
     */
    private $magasinStock;

    /**
     * @ORM\OneToOne(targetEntity=MatierePremiereCommande::class, mappedBy="matierePremiere", cascade={"persist", "remove"})
     */
    private $matierePremiereCommande;

    /**
     * @ORM\OneToOne(targetEntity=DetailAppro::class, mappedBy="matierePremiere", cascade={"persist", "remove"})
     */
    private $detailAppro;

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

    public function getMatierePremiereCommande(): ?MatierePremiereCommande
    {
        return $this->matierePremiereCommande;
    }

    public function setMatierePremiereCommande(MatierePremiereCommande $matierePremiereCommande): self
    {
        $this->matierePremiereCommande = $matierePremiereCommande;

        // set the owning side of the relation if necessary
        if ($matierePremiereCommande->getMatierePremiere() !== $this) {
            $matierePremiereCommande->setMatierePremiere($this);
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
}
