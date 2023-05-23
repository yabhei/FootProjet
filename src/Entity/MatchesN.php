<?php

namespace App\Entity;

use App\Repository\MatchesNRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchesNRepository::class)]
class MatchesN
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $teamResult1 = null;

    #[ORM\Column(nullable: true)]
    private ?int $teamResult2 = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $matchDate = null;

    #[ORM\ManyToOne(inversedBy: 'matchesNs')]
    private ?Team $teamN1 = null;

    #[ORM\ManyToOne(inversedBy: 'matchesNs')]
    private ?Team $teamN2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamResult1(): ?int
    {
        return $this->teamResult1;
    }

    public function setTeamResult1(?int $teamResult1): self
    {
        $this->teamResult1 = $teamResult1;

        return $this;
    }

    public function getTeamResult2(): ?int
    {
        return $this->teamResult2;
    }

    public function setTeamResult2(?int $teamResult2): self
    {
        $this->teamResult2 = $teamResult2;

        return $this;
    }

    public function getMatchDate(): ?\DateTimeInterface
    {
        return $this->matchDate;
    }

    public function setMatchDate(\DateTimeInterface $matchDate): self
    {
        $this->matchDate = $matchDate;

        return $this;
    }

    public function getTeamN1(): ?Team
    {
        return $this->teamN1;
    }

    public function setTeamN1(?Team $teamN1): self
    {
        $this->teamN1 = $teamN1;

        return $this;
    }

    public function getTeamN2(): ?Team
    {
        return $this->teamN2;
    }

    public function setTeamN2(?Team $teamN2): self
    {
        $this->teamN2 = $teamN2;

        return $this;
    }
}
