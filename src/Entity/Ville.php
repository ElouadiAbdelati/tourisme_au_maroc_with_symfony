<?php

namespace App\Entity;

use App\Entity\Marker;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VilleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use EasyCorp\Bundle\EasyAdminBundle\Mapping\Annotation as EA;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 * @Vich\Uploadable
 */
class Ville
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="ville_path", fileNameProperty="image")
     * @var File
     */
    private $imgPathFile;


    /**
     * @ORM\OneToMany(targetEntity="Marker", mappedBy="ville")
     */
    private $markers;

    /**
     * @ORM\OneToMany(targetEntity="Hotel", mappedBy="ville")
     */
    private $hotels;

    /**
     * @ORM\OneToMany(targetEntity="Activite", mappedBy="ville")
     */
    private $activites;

    /**
     * @ORM\OneToMany(targetEntity="Camping", mappedBy="ville")
     */
    private $campings;

    /**
     * @ORM\OneToMany(targetEntity="Resto", mappedBy="ville")
     */
    private $restos;

    /**
     * @ORM\ManyToOne(targetEntity="Region", inversedBy="villes")
     */
    private $region;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Comentaire::class, mappedBy="ville", orphanRemoval=true)
     */
    private $comentaires;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=VilleLike::class, mappedBy="ville")
     */
    private $likes;

    public function __construct()
    {
        $this->markers = new ArrayCollection();
        $this->hotels = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->campings = new ArrayCollection();
        $this->restos = new ArrayCollection();
        $this->comentaires = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->likes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Hotel[]
     */
    public function getHotels(): Collection
    {
        return $this->hotels;
    }

    public function addHotel(Hotel $hotel): self
    {
        if (!$this->hotels->contains($hotel)) {
            $this->hotels[] = $hotel;
            $hotel->setVille($this);
        }

        return $this;
    }

    public function removeHotel(Hotel $hotel): self
    {
        if ($this->hotels->contains($hotel)) {
            $this->hotels->removeElement($hotel);
            // set the owning side to null (unless already changed)
            if ($hotel->getVille() === $this) {
                $hotel->setVille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activite $activite): self
    {
        if (!$this->activites->contains($activite)) {
            $this->activites[] = $activite;
            $activite->setVille($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->contains($activite)) {
            $this->activites->removeElement($activite);
            // set the owning side to null (unless already changed)
            if ($activite->getVille() === $this) {
                $activite->setVille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Camping[]
     */
    public function getCampings(): Collection
    {
        return $this->campings;
    }

    public function addCamping(Camping $camping): self
    {
        if (!$this->campings->contains($camping)) {
            $this->campings[] = $camping;
            $camping->setVille($this);
        }

        return $this;
    }

    public function removeCamping(Camping $camping): self
    {
        if ($this->campings->contains($camping)) {
            $this->campings->removeElement($camping);
            // set the owning side to null (unless already changed)
            if ($camping->getVille() === $this) {
                $camping->setVille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Resto[]
     */
    public function getRestos(): Collection
    {
        return $this->restos;
    }

    public function addResto(Resto $resto): self
    {
        if (!$this->restos->contains($resto)) {
            $this->restos[] = $resto;
            $resto->setVille($this);
        }

        return $this;
    }

    public function removeResto(Resto $resto): self
    {
        if ($this->restos->contains($resto)) {
            $this->restos->removeElement($resto);
            // set the owning side to null (unless already changed)
            if ($resto->getVille() === $this) {
                $resto->setVille(null);
            }
        }

        return $this;
    }


    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

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

    /**
     * @return Collection|Comentaire[]
     */
    public function getComentaires(): Collection
    {
        return $this->comentaires;
    }

    public function addComentaire(Comentaire $comentaire): self
    {
        if (!$this->comentaires->contains($comentaire)) {
            $this->comentaires[] = $comentaire;
            $comentaire->setVille($this);

        }
        return $this;
    }
 
    /**     
     * @return Collection|Marker[]
     */
    public function getMarkers(): Collection
    {
        return $this->markers;
    }

    public function addMarker(Marker $marker): self
    {
        if (!$this->markers->contains($marker)) {
            $this->markers[] = $marker;
            $marker->setVille($this);
        }

        return $this;
    }

    public function removeComentaire(Comentaire $comentaire): self
    {
        if ($this->comentaires->contains($comentaire)) {
            $this->comentaires->removeElement($comentaire);
            // set the owning side to null (unless already changed)
            if ($comentaire->getVille() === $this) {
                $comentaire->setVille(null);

            }
       }
       return $this;
    }

                
    public function removeMarker(Marker $marker): self
    {
        if ($this->markers->contains($marker)) {
            $this->markers->removeElement($marker);
            // set the owning side to null (unless already changed)
            if ($marker->getVille() === $this) {
                $marker->setVille(null);
            }
        }

        return $this;
    }

    public function getImgPathFile()
    {
        return $this->imgPathFile;
    }

    /**
     * @param mixed $imgPathFile
     * @throws \Exception
     */
    public function setImgPathFile(File $image = null): void
    {
        $this->imgPathFile = $image;
        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|VilleLike[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(VilleLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setVille($this);
        }

        return $this;
    }

    public function removeLike(VilleLike $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getVille() === $this) {
                $like->setVille(null);
            }
        }

        return $this;
    }

    /** 
    *  @param User $user
    *  @return boolen
    */
    public function isLikedByUser(User $user):bool{
      foreach($this->likes as $like){
          if($like->getUser()===$user)return true;
      }
      return  false ;
    }
}
