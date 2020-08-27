<?php

namespace App\Entity;

use App\Repository\ComentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComentaireRepository::class)
 */
class Comentaire
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
    private $comentaire;
     /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="comentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComentaire(): ?string
    {
        return $this->comentaire;
    }

   
    public function setComentaire(string $comentaire): self
    {
        $this->comentaire = $comentaire;

        return $this;
    }
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    
    public function getImage(): ?string
    {
        return $this->image;
    }


    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

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
