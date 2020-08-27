<?php

namespace App\Entity;

use App\Repository\CampingLikeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampingLikeRepository::class)
 */
class CampingLike
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Camping::class, inversedBy="likes")
     */
    private $camping;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="campingLikes")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCamping(): ?Camping
    {
        return $this->camping;
    }

    public function setCamping(?Camping $camping): self
    {
        $this->camping = $camping;

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
