<?php

namespace App\Entity;

use App\Repository\MoyenDeTransportRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=MoyenDeTransportRepository::class)
 *  @UniqueEntity(
 *     fields={"id"},
 *     message="id already exist !"
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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Type is required")
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Num_ligne is required")
     */
    private $Num_ligne;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Date_de_mise_en_circulations is required")
     */
    private $Date_de_mise_en_circulations;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Etat is required")
     */
    private $Etat;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Accessible_au_handicape is required")
     */
    private $Accessible_au_handicape;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Prix_Achat is required")
     */
    private $Prix_Achat;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Poids is required")
     */
    private $Poids;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Longueur is required")
     */
    private $Longueur;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Largeur is required")
     */
    private $Largeur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Energie is required")
     */
    private $Energie;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Nombre_de_place is required")
     */
    private $Nombre_de_place;

    /**
     * @ORM\ManyToOne(targetEntity=Depot::class, inversedBy="MoyenDeTransport")
     */
    private $depot;

    /**
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getNumLigne(): ?string
    {
        return $this->Num_ligne;
    }

    public function setNumLigne(string $Num_ligne): self
    {
        $this->Num_ligne = $Num_ligne;

        return $this;
    }

    public function getDateDeMiseEnCirculations(): ?\DateTimeInterface
    {
        return $this->Date_de_mise_en_circulations;
    }

    public function setDateDeMiseEnCirculations(\DateTimeInterface $Date_de_mise_en_circulations): self
    {
        $this->Date_de_mise_en_circulations = $Date_de_mise_en_circulations;

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

    public function getAccessibleAuHandicape(): ?string
    {
        return $this->Accessible_au_handicape;
    }

    public function setAccessibleAuHandicape(string $Accessible_au_handicape): self
    {
        $this->Accessible_au_handicape = $Accessible_au_handicape;

        return $this;
    }

    public function getPrixAchat(): ?string
    {
        return $this->Prix_Achat;
    }

    public function setPrixAchat(string $Prix_Achat): self
    {
        $this->Prix_Achat = $Prix_Achat;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->Poids;
    }

    public function setPoids(float $Poids): self
    {
        $this->Poids = $Poids;

        return $this;
    }

    public function getLongueur(): ?float
    {
        return $this->Longueur;
    }

    public function setLongueur(float $Longueur): self
    {
        $this->Longueur = $Longueur;

        return $this;
    }

    public function getLargeur(): ?float
    {
        return $this->Largeur;
    }

    public function setLargeur(float $Largeur): self
    {
        $this->Largeur = $Largeur;

        return $this;
    }

    public function getEnergie(): ?string
    {
        return $this->Energie;
    }

    public function setEnergie(string $Energie): self
    {
        $this->Energie = $Energie;

        return $this;
    }

    public function getNombreDePlace(): ?int
    {
        return $this->Nombre_de_place;
    }

    public function setNombreDePlace(int $Nombre_de_place): self
    {
        $this->Nombre_de_place = $Nombre_de_place;

        return $this;
    }

    public function getDepot(): ?Depot
    {
        return $this->depot;
    }

    public function setDepot(?Depot $depot): self
    {
        $this->depot = $depot;

        return $this;
    }

    public function __toString(){
        // to show the name of the Category in the select
        return (String)$this->getId();
        // to show the id of the Category in the select
        // return $this->id;
    }
}
