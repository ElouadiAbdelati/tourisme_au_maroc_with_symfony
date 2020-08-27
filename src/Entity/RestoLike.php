<?php

namespace App\Entity;

use App\Repository\RestoLikeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestoLikeRepository::class)
 */
class RestoLike
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Resto::class, inversedBy="likes")
     */
    private $resto;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="restoLikes")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResto(): ?Resto
    {
        return $this->resto;
    }

    public function setResto(?Resto $resto): self
    {
        $this->resto = $resto;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
    
}
