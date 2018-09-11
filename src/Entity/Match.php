<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatchRepository")
 */
class Match
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="wherePlayerOne")
     * @ORM\JoinColumn(nullable=false)
     */
    private $playerOne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="wherePlayerTwo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $playerTwo;

    /**
     * @ORM\Column(type="integer")
     */
    private $playerOneScore;

    /**
     * @ORM\Column(type="integer")
     */
    private $playerTwoScore;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $winner;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayerOneScore(): ?int
    {
        return $this->playerOneScore;
    }

    public function setPlayerOneScore(int $playerOneScore): self
    {
        $this->playerOneScore = $playerOneScore;

        return $this;
    }

    public function getPlayerTwoScore(): ?int
    {
        return $this->playerTwoScore;
    }

    public function setPlayerTwoScore(int $playerTwoScore): self
    {
        $this->playerTwoScore = $playerTwoScore;

        return $this;
    }

    public function getWinner(): ?User
    {
        return $this->winner;
    }

    public function setWinner(?User $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeInterface $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->endedAt;
    }

    public function setEndedAt(\DateTimeInterface $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getPlayerOne(): ?User
    {
        return $this->playerOne;
    }

    public function setPlayerOne(?User $playerOne): self
    {
        $this->playerOne = $playerOne;

        return $this;
    }

    public function getPlayerTwo(): ?User
    {
        return $this->playerTwo;
    }

    public function setPlayerTwo(?User $playerTwo): self
    {
        $this->playerTwo = $playerTwo;

        return $this;
    }
}
