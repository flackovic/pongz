<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Match", mappedBy="playerOne")
     */
    private $wherePlayerOne;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Match", mappedBy="playerTwo")
     */
    private $wherePlayerTwo;

    public function __construct()
    {
        $this->wherePlayerOne = new ArrayCollection();
        $this->wherePlayerTwo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|Match[]
     */
    public function getWherePlayerOne(): Collection
    {
        return $this->wherePlayerOne;
    }

    public function addWherePlayerOne(Match $wherePlayerOne): self
    {
        if (!$this->wherePlayerOne->contains($wherePlayerOne)) {
            $this->wherePlayerOne[] = $wherePlayerOne;
            $wherePlayerOne->setPlayerOne($this);
        }

        return $this;
    }

    public function removeWherePlayerOne(Match $wherePlayerOne): self
    {
        if ($this->wherePlayerOne->contains($wherePlayerOne)) {
            $this->wherePlayerOne->removeElement($wherePlayerOne);
            // set the owning side to null (unless already changed)
            if ($wherePlayerOne->getPlayerOne() === $this) {
                $wherePlayerOne->setPlayerOne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Match[]
     */
    public function getWherePlayerTwo(): Collection
    {
        return $this->wherePlayerTwo;
    }

    public function addWherePlayerTwo(Match $wherePlayerTwo): self
    {
        if (!$this->wherePlayerTwo->contains($wherePlayerTwo)) {
            $this->wherePlayerTwo[] = $wherePlayerTwo;
            $wherePlayerTwo->setPlayerTwo($this);
        }

        return $this;
    }

    public function removeWherePlayerTwo(Match $wherePlayerTwo): self
    {
        if ($this->wherePlayerTwo->contains($wherePlayerTwo)) {
            $this->wherePlayerTwo->removeElement($wherePlayerTwo);
            // set the owning side to null (unless already changed)
            if ($wherePlayerTwo->getPlayerTwo() === $this) {
                $wherePlayerTwo->setPlayerTwo(null);
            }
        }

        return $this;
    }
}
