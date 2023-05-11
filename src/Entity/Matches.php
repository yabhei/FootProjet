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

    #[ORM\Column]
    private ?int $result1 = null;

    #[ORM\Column]
    private ?int $result2 = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $date_match = null;


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

    public function getResult1(): ?int
    {
        return $this->result1;
    }

    public function setResult1(int $result1): self
    {
        $this->result1 = $result1;

        return $this;
    }

    public function getResult2(): ?int
    {
        return $this->result2;
    }

    public function setResult2(int $result2): self
    {
        $this->result2 = $result2;

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
}
