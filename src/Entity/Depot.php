<?php

namespace App\Entity;

use App\Repository\DepotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DepotRepository::class)
 */
class Depot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Capacite is required")
     * @Assert\GreaterThan(20,message="verifier la capacité minimum 20 MoyenTransport")
     */
    private $Capacite;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Categorie is required")
     */
    private $Categorie;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Localisation is required")
     */
    private $Localisation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Etat is required")
     */
    private $Etat;

    /**
     * @ORM\OneToMany(targetEntity=MoyenDeTransport::class, mappedBy="depot")
     */
    private $moyenDeTransport;

    public function __construct()
    {
        $this->moyenDeTransport = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapacite(): ?string
    {
        return $this->Capacite;
    }

    public function setCapacite(string $Capacite): self
    {
        $this->Capacite = $Capacite;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->Categorie;
    }

    public function setCategorie(string $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->Localisation;
    }

    public function setLocalisation(string $Localisation): self
    {
        $this->Localisation = $Localisation;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->Etat;
    }

    public function setEtat(string $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }

    /**
     * @return Collection|MoyenDeTransport[]
     */
    public function getMoyenDeTransport(): Collection
    {
        return $this->moyenDeTransport;
    }

    public function addMoyenDeTransport(MoyenDeTransport $moyenDeTransport): self
    {
        if (!$this->moyenDeTransport->contains($moyenDeTransport)) {
            $this->moyenDeTransport[] = $moyenDeTransport;
            $moyenDeTransport->setDepot($this);
        }

        return $this;
    }

    public function removeMoyenDeTransport(MoyenDeTransport $moyenDeTransport): self
    {
        if ($this->moyenDeTransport->removeElement($moyenDeTransport)) {
            // set the owning side to null (unless already changed)
            if ($moyenDeTransport->getDepot() === $this) {
                $moyenDeTransport->setDepot(null);
            }
        }

        return $this;
    }
}