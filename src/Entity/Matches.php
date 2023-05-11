<?php

namespace App\Entity;

use App\Repository\MatchesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchesRepository::class)]
class Matches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $team_1 = null;

    #[ORM\Column(length: 70)]
    private ?string $team_2 = null;

    #[ORM\Column]
    private ?int $result_1 = null;

    #[ORM\Column]
    private ?int $result_2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeam1(): ?string
    {
        return $this->team_1;
    }

    public function setTeam1(string $team_1): self
    {
        $this->team_1 = $team_1;

        return $this;
    }

    public function getTeam2(): ?string
    {
        return $this->team_2;
    }

    public function setTeam2(string $team_2): self
    {
        $this->team_2 = $team_2;

        return $this;
    }

    public function getResult1(): ?int
    {
        return $this->result_1;
    }

    public function setResult1(int $result_1): self
    {
        $this->result_1 = $result_1;

        return $this;
    }

    public function getResult2(): ?int
    {
        return $this->result_2;
    }

    public function setResult2(int $result_2): self
    {
        $this->result_2 = $result_2;

        return $this;
    }
}
