<?php

namespace App\Entity;

use App\Repository\ApproRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApproRepository::class)
 */
class Appro
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
    private $dateAppro;

    /**
     * @ORM\OneToMany(targetEntity=DetailAppro::class, mappedBy="appro", orphanRemoval=true)
     */
    private $detailAppros;

    public function __construct()
    {
        $this->detailAppros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAppro(): ?\DateTimeInterface
    {
        return $this->dateAppro;
    }

    public function setDateAppro(\DateTimeInterface $dateAppro): self
    {
        $this->dateAppro = $dateAppro;

        return $this;
    }

    /**
     * @return Collection|DetailAppro[]
     */
    public function getDetailAppros(): Collection
    {
        return $this->detailAppros;
    }

    public function addDetailAppro(DetailAppro $detailAppro): self
    {
        if (!$this->detailAppros->contains($detailAppro)) {
            $this->detailAppros[] = $detailAppro;
            $detailAppro->setAppro($this);
        }

        return $this;
    }

    public function removeDetailAppro(DetailAppro $detailAppro): self
    {
        if ($this->detailAppros->contains($detailAppro)) {
            $this->detailAppros->removeElement($detailAppro);
            // set the owning side to null (unless already changed)
            if ($detailAppro->getAppro() === $this) {
                $detailAppro->setAppro(null);
            }
        }

        return $this;
    }
}
