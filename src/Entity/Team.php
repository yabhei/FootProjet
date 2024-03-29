<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]


    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $country = null;

    #[ORM\Column(length: 50)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: Player::class)]
    private Collection $players;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: User::class)]
    private Collection $users;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $captain = null;

    #[ORM\ManyToMany(targetEntity: Matches::class)]
    private Collection $matches;

    #[ORM\ManyToMany(targetEntity: Matches::class, mappedBy: 'mTeam1')]
    private Collection $matchesN;

    #[ORM\OneToMany(mappedBy: 'teamN1', targetEntity: MatchesN::class)]
    private Collection $matchesNs;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->creationDate = new \DateTime();
        $this->matches = new ArrayCollection();
        $this->matchesN = new ArrayCollection();
        $this->matchesNs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
            $player->setTeam($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getTeam() === $this) {
                $player->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setTeam($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getTeam() === $this) {
                $user->setTeam(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->getName();
    }

    public function getCaptain(): ?string
    {
        return $this->captain;
    }

    public function setCaptain(?string $captain): self
    {
        $this->captain = $captain;

        return $this;
    }

    // /**
    //  * @return Collection<int, Matches>
    //  */
    // public function getMatches(): Collection
    // {
    //     return $this->matches;
    // }

    // public function addMatch(Matches $match): self
    // {
    //     if (!$this->matches->contains($match)) {
    //         $this->matches->add($match);
    //     }

    //     return $this;
    // }

    // public function removeMatch(Matches $match): self
    // {
    //     $this->matches->removeElement($match);

    //     return $this;
    // }

    /**
     * @return Collection<int, MatchesN>
     */
    public function getMatchesN(): Collection
    {
        return $this->matchesN;
    }

    public function addMatchesN(MatchesN $matchesN): self
    {
        if (!$this->matchesN->contains($matchesN)) {
            $this->matchesN->add($matchesN);
            $matchesN->addMTeam1($this);
        }

        return $this;
    }

    public function removeMatchesN(MatchesN $matchesN): self
    {
        if ($this->matchesN->removeElement($matchesN)) {
            $matchesN->removeMTeam1($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, MatchesN>
     */
    public function getMatchesNs(): Collection
    {
        return $this->matchesNs;
    }
}
