<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomClub = null;

    #[ORM\Column(length: 50)]
    private ?string $sportClub = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseClub = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClub(): ?string
    {
        return $this->nomClub;
    }

    public function setNomClub(string $nomClub): self
    {
        $this->nomClub = $nomClub;

        return $this;
    }

    public function getSportClub(): ?string
    {
        return $this->sportClub;
    }

    public function setSportClub(string $sportClub): self
    {
        $this->sportClub = $sportClub;

        return $this;
    }

    public function getAdresseClub(): ?string
    {
        return $this->adresseClub;
    }

    public function setAdresseClub(string $adresseClub): self
    {
        $this->adresseClub = $adresseClub;

        return $this;
    }
}
