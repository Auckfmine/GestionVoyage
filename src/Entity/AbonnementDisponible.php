<?php

namespace App\Entity;

use App\Repository\AbonnementDisponibleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AbonnementDisponibleRepository::class)
 */
class AbonnementDisponible
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_mois;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_semestre;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_annuel;

    /**
     * @ORM\OneToMany(targetEntity=Abonnement::class, mappedBy="AbonnementDisponible")
     */
    private $abonnements;

    public function __construct()
    {
        $this->abonnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescr(): ?string
    {
        return $this->descr;
    }

    public function setDescr(string $descr): self
    {
        $this->descr = $descr;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPrixMois(): ?float
    {
        return $this->prix_mois;
    }

    public function setPrixMois(float $prix_mois): self
    {
        $this->prix_mois = $prix_mois;

        return $this;
    }

    public function getPrixSemestre(): ?float
    {
        return $this->prix_semestre;
    }

    public function setPrixSemestre(float $prix_semestre): self
    {
        $this->prix_semestre = $prix_semestre;

        return $this;
    }

    public function getPrixAnnuel(): ?float
    {
        return $this->prix_annuel;
    }

    public function setPrixAnnuel(float $prix_annuel): self
    {
        $this->prix_annuel = $prix_annuel;

        return $this;
    }

    /**
     * @return Collection|Abonnement[]
     */
    public function getAbonnements(): Collection
    {
        return $this->abonnements;
    }

    public function addAbonnement(Abonnement $abonnement): self
    {
        if (!$this->abonnements->contains($abonnement)) {
            $this->abonnements[] = $abonnement;
            $abonnement->setAbonnementDisponible($this);
        }

        return $this;
    }

    public function removeAbonnement(Abonnement $abonnement): self
    {
        if ($this->abonnements->removeElement($abonnement)) {
            // set the owning side to null (unless already changed)
            if ($abonnement->getAbonnementDisponible() === $this) {
                $abonnement->setAbonnementDisponible(null);
            }
        }

        return $this;
    }
}
