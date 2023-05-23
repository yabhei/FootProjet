<?php

namespace App\Entity;

use Date;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MatchesRepository;

#[ORM\Entity(repositoryClass: MatchesRepository::class)]
class Matches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $team1 = null;

    #[ORM\Column(length: 70)]
    private ?string $team2 = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $date_match = null;

    #[ORM\Column(nullable: true)]
    private ?int $resultTeam1 = null;

    #[ORM\Column(nullable: true)]
    private ?int $resultTeam2 = null;


    public function __construct()
    {
      
        
        
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeam1(): ?string
    {
        return $this->team1;
    }

    public function setTeam1(string $team1): self
    {
        $this->team1 = $team1;

        return $this;
    }

    public function getTeam2(): ?string
    {
        return $this->team2;
    }

    public function setTeam2(string $team2): self
    {
        $this->team2 = $team2;

        return $this;
    }

    public function getDateMatch(): ?DateTimeInterface
    {
        return $this->date_match;
    }

    public function setDateMatch(DateTimeInterface $date_match): self
    {
        $this->date_match = $date_match;

        return $this;
    }

    public function getResultTeam1(): ?int
    {
        return $this->resultTeam1;
    }

    public function setResultTeam1(?int $resultTeam1): self
    {
        $this->resultTeam1 = $resultTeam1;

        return $this;
    }

    public function getResultTeam2(): ?int
    {
        return $this->resultTeam2;
    }

    public function setResultTeam2(?int $resultTeam2): self
    {
        $this->resultTeam2 = $resultTeam2;

        return $this;
    }
}
