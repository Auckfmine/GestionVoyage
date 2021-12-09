<?php

namespace App\Entity;

use App\Repository\VoyageArchiveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoyageArchiveRepository::class)
 */
class VoyageArchive
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $ref_voyage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $station_depart;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $MoyenDeTransport;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_depart;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_arrive;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Station_arrive;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefVoyage(): ?string
    {
        return $this->ref_voyage;
    }

    public function setRefVoyage(?string $ref_voyage): self
    {
        $this->ref_voyage = $ref_voyage;

        return $this;
    }

    public function getStationDepart(): ?int
    {
        return $this->station_depart;
    }

    public function setStationDepart(?int $station_depart): self
    {
        $this->station_depart = $station_depart;

        return $this;
    }

    public function getMoyenDeTransport(): ?int
    {
        return $this->MoyenDeTransport;
    }

    public function setMoyenDeTransport(?int $MoyenDeTransport): self
    {
        $this->MoyenDeTransport = $MoyenDeTransport;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(?\DateTimeInterface $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getDateArrive(): ?\DateTimeInterface
    {
        return $this->date_arrive;
    }

    public function setDateArrive(?\DateTimeInterface $date_arrive): self
    {
        $this->date_arrive = $date_arrive;

        return $this;
    }

    public function getStationArrive(): ?int
    {
        return $this->Station_arrive;
    }

    public function setStationArrive(?int $Station_arrive): self
    {
        $this->Station_arrive = $Station_arrive;

        return $this;
    }
}
