<?php

namespace App\Entity;

use App\Repository\MoyenDeTransportRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=MoyenDeTransportRepository::class)
 * @UniqueEntity(
 *     fields={"ref"},
 *     message="ref_mt already exist !"
 * )
 */
class MoyenDeTransport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128,unique=true)
     *
     */
    private $ref;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $typeMt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accessible_handicap;

    /**
     * @ORM\OneToOne(targetEntity=Voyage::class, mappedBy="MoyenDeTransport", cascade={"persist", "remove"})
     */
    private $voyage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getTypeMt(): ?string
    {
        return $this->typeMt;
    }

    public function setTypeMt(string $typeMt): self
    {
        $this->typeMt = $typeMt;

        return $this;
    }

    public function getAccessibleHandicap(): ?bool
    {
        return $this->accessible_handicap;
    }

    public function setAccessibleHandicap(bool $accessible_handicap): self
    {
        $this->accessible_handicap = $accessible_handicap;

        return $this;
    }

    public function getVoyage(): ?Voyage
    {
        return $this->voyage;
    }

    public function setVoyage(Voyage $voyage): self
    {
        // set the owning side of the relation if necessary
        if ($voyage->getMoyenDeTransport() !== $this) {
            $voyage->setMoyenDeTransport($this);
        }

        $this->voyage = $voyage;

        return $this;
    }

    public function __toString(){
        // to show the name of the Category in the select
        return $this->getRef();
        // to show the id of the Category in the select
        // return $this->id;
    }
}
