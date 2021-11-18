<?php

namespace App\Entity;

use App\Repository\DepotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Capacité is required")
     */
    private $Capacité;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Catégorie is required")
     */
    private $Catégorie;

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
    private $MoyenDeTransport;

    public function __construct()
    {
        $this->MoyenDeTransport = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapacité(): ?int
    {
        return $this->Capacité;
    }

    public function setCapacité(int $Capacité): self
    {
        $this->Capacité = $Capacité;

        return $this;
    }

    public function getCatégorie(): ?string
    {
        return $this->Catégorie;
    }

    public function setCatégorie(string $Catégorie): self
    {
        $this->Catégorie = $Catégorie;

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
        return $this->MoyenDeTransport;
    }

    public function addMoyenDeTransport(MoyenDeTransport $moyenDeTransport): self
    {
        if (!$this->MoyenDETransport->contains($moyenDeTransport)) {
            $this->MoyenDeTransport[] = $moyenDeTransport;
            $moyenDeTransport->setDepot($this);
        }

        return $this;
    }

    public function removeMoyenDeTransport(MoyenDeTransport $moyenDeTransport): self
    {
        if ($this->MoyenDeTransport->removeElement($moyenDeTransport)) {
            // set the owning side to null (unless already changed)
            if ($moyenDeTransport->getDepot() === $this) {
                $moyenDeTransport->setDepot(null);
            }
        }

        return $this;
    }
}
