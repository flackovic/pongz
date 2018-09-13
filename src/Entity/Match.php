<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="wherePlayerOne")
     * @ORM\JoinColumn(nullable=false)
     */
    private $playerOne;

    /**
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="wherePlayerTwo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $playerTwo;

    /**
     * @ORM\Column(type="integer")
     */
    private $playerOneScore = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $playerTwoScore = 0;

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

    public function scoreForPlayerOne(): void
    {
        $this->playerOneScore++;
    }

    public function scoreForPlayerTwo(): void
    {
        $this->playerTwoScore++;
    }

    public function getSetsPlayed(): int
    {
        return $this->playerOneScore + $this->playerTwoScore;
    }

    public function isScoreValid(): bool
    {
        /** There should never be more than 5 games played */
        if (($this->playerOneScore + $this->playerTwoScore) > 5) {
            return false;
        }
        /** No player should have more than 3 points, since 3 points is considered victory */
        if($this->playerOneScore > 3 || $this->playerTwoScore > 3) {
            return false;
        }
        /** Players can't have negative score */
        if ($this->playerOneScore < 0 || $this->playerTwoScore < 0) {
            return false;
        }

        return true;
    }

    public function declareWinner(): self
    {
        if($this->playerOneScore === $this->playerTwoScore) {
            $this->setWinner(null);

            return $this;
        }

        $winner = $this->getPlayerOneScore() > $this->getPlayerTwoScore() ? $this->getPlayerOne() : $this->getPlayerTwo();

        $this->setWinner($winner);

        return $this;
    }
}
