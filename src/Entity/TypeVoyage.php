<?php

namespace App\Entity;

use App\Repository\TypeVoyageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeVoyageRepository::class)
 */
class TypeVoyage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $typeVoyage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeVoyage(): ?string
    {
        return $this->typeVoyage;
    }

    public function setTypeVoyage(string $typeVoyage): self
    {
        $this->typeVoyage = $typeVoyage;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
