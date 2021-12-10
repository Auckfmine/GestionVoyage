<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $titre;

    /**
     * @ORM\OneToMany(targetEntity=Reclamation::class, mappedBy="category")
     */
    private $reclamation;

    public function __construct()
    {
        $this->reclamation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection|Reclamation[]
     */
    public function getReclamation(): Collection
    {
        return $this->reclamation;
    }

    public function addReclamation(Reclamation $reclamation): self
    {
        if (!$this->reclamation->contains($reclamation)) {
            $this->reclamation[] = $reclamation;
            $reclamation->setCategory($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): self
    {
        if ($this->reclamation->removeElement($reclamation)) {
            // set the owning side to null (unless already changed)
            if ($reclamation->getCategory() === $this) {
                $reclamation->setCategory(null);
            }
        }

        return $this;
    }
}
