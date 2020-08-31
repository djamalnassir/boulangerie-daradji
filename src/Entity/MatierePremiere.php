<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MatierePremiereRepository;

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
     * @ORM\OneToOne(targetEntity=DetailCommande::class, mappedBy="matierePremiere", cascade={"persist", "remove"})
     */
    private $detailCommande;

    /**
     * @ORM\OneToOne(targetEntity=DetailAppro::class, mappedBy="matierePremiere", cascade={"persist", "remove"})
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

    /**
     * Get the value of detailCommande
     */ 
    public function getDetailCommande()
    {
        return $this->detailCommande;
    }

    /**
     * Set the value of detailCommande
     *
     * @return  self
     */ 
    public function setDetailCommande($detailCommande)
    {
        $this->detailCommande = $detailCommande;

        return $this;
    }
}
