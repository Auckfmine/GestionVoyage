<?php

namespace App\Entity;

use App\Repository\VoyageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=VoyageRepository::class)
 * @UniqueEntity(
 *     fields={"ref_voyage"},
 *     message="ref_voyage already exist !"
 * )
 */
class Voyage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128,unique=true)
     * @Assert\NotBlank(message="ref_voyage is required")
     *
     *
     */
    private $ref_voyage;

    /**
     * @ORM\ManyToOne (targetEntity=Station::class, inversedBy="voyage",cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Station is required")
     */
    private $station_depart;

    /**
     * @ORM\ManyToOne (targetEntity=Station::class,inversedBy="voyage" ,cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Station_arrive is required")
     */
    private $Station_arrive;

    /**
     * @ORM\Column(type="array", nullable=true)
     *
     */
    private $ligne = [];

    /**
     * @ORM\ManyToOne(targetEntity=MoyenDeTransport::class, inversedBy="voyage", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="MoyenDeTransport is required")
     */
    private $MoyenDeTransport;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message="date_depart is required")
     */
    private $date_depart;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message="date_arrive is required")
     */
    private $date_arrive;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefVoyage(): ?string
    {
        return $this->ref_voyage;
    }

    public function setRefVoyage(string $ref_voyage): self
    {
        $this->ref_voyage = $ref_voyage;

        return $this;
    }

    public function getStationDepart(): ?Station
    {
        return $this->station_depart;
    }

    public function setStationDepart(Station $station_depart): self
    {
        $this->station_depart = $station_depart;

        return $this;
    }

    public function getStationArrive(): ?Station
    {
        return $this->Station_arrive;
    }

    public function setStationArrive(Station $Station_arrive): self
    {
        $this->Station_arrive = $Station_arrive;

        return $this;
    }

    public function getLigne(): ?array
    {
        return $this->ligne;
    }

    public function setLigne(?array $ligne): self
    {
        $this->ligne = $ligne;

        return $this;
    }

    public function getMoyenDeTransport(): ?MoyenDeTransport
    {
        return $this->MoyenDeTransport;
    }

    public function setMoyenDeTransport(MoyenDeTransport $MoyenDeTransport): self
    {
        $this->MoyenDeTransport = $MoyenDeTransport;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(\DateTimeInterface $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getDateArrive(): ?\DateTimeInterface
    {
        return $this->date_arrive;
    }

    public function setDateArrive(\DateTimeInterface $date_arrive): self
    {
        $this->date_arrive = $date_arrive;

        return $this;
    }
}
