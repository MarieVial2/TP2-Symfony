<?php

namespace App\Entity;

use App\Repository\LicencieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LicencieRepository::class)]
class Licencie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomLicencie = null;

    #[ORM\Column(length: 50)]
    private ?string $prenomLicencie = null;

    #[ORM\Column(length: 255)]
    private ?string $photoLicencie = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Club $idClub = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipe $idEquipe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLicencie(): ?string
    {
        return $this->nomLicencie;
    }

    public function setNomLicencie(string $nomLicencie): self
    {
        $this->nomLicencie = $nomLicencie;

        return $this;
    }

    public function getPrenomLicencie(): ?string
    {
        return $this->prenomLicencie;
    }

    public function setPrenomLicencie(string $prenomLicencie): self
    {
        $this->prenomLicencie = $prenomLicencie;

        return $this;
    }

    public function getPhotoLicencie(): ?string
    {
        return $this->photoLicencie;
    }

    public function setPhotoLicencie(string $photoLicencie): self
    {
        $this->photoLicencie = $photoLicencie;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getIdClub(): ?Club
    {
        return $this->idClub;
    }

    public function setIdClub(?Club $idClub): self
    {
        $this->idClub = $idClub;

        return $this;
    }

    public function getIdEquipe(): ?Equipe
    {
        return $this->idEquipe;
    }

    public function setIdEquipe(?Equipe $idEquipe): self
    {
        $this->idEquipe = $idEquipe;

        return $this;
    }
}
