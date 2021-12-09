<?php

namespace App\Entity;

use App\Repository\StationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=StationRepository::class)
 *  @UniqueEntity(
 *     fields={"ref_station"},
 *     message="ref_station already exist !"
 * )
 */
class Station
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer",)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128,unique=true)
     * @Assert\NotBlank(message="ref_station is required")
     *
     *
     */
    private $ref_station;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank(message="nom_station is required")
     */
    private $nom_station;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank(message="position_station is required")
     */
    private $position_station;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefStation(): ?string
    {
        return $this->ref_station;
    }

    public function setRefStation(string $ref_station): self
    {
        $this->ref_station = $ref_station;

        return $this;
    }

    public function getNomStation(): ?string
    {
        return $this->nom_station;
    }

    public function setNomStation(string $nom_station): self
    {
        $this->nom_station = $nom_station;

        return $this;
    }

    public function getPositionStation(): ?string
    {
        return $this->position_station;
    }

    public function setPositionStation(string $position_station): self
    {
        $this->position_station = $position_station;

        return $this;
    }
    public function __toString(){
        // to show the name of the Category in the select
        return $this->getNomStation();
        // to show the id of the Category in the select
        // return $this->id;
    }
}
