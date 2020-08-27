<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=30, unique=true)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $tel;

    /**
     * @ORM\OneToMany(targetEntity=Comentaire::class, mappedBy="user", orphanRemoval=true)
     */
    private $comentaires;

    /**
     * @ORM\OneToMany(targetEntity=VilleLike::class, mappedBy="user")
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity=HotelLike::class, mappedBy="user")
     */
    private $hotelLikes;

    /**
     * @ORM\OneToMany(targetEntity=RestoLike::class, mappedBy="user")
     */
    private $restoLikes;

    /**
     * @ORM\OneToMany(targetEntity=ActiviteLike::class, mappedBy="user")
     */
    private $activiteLikes;

    /**
     * @ORM\OneToMany(targetEntity=CampingLike::class, mappedBy="user")
     */
    private $campingLikes;

    /**
     * @ORM\OneToMany(targetEntity=Blog::class, mappedBy="user")
     */
    private $blogs;

    public function __construct()
    {
        $this->comentaires = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->hotelLikes = new ArrayCollection();
        $this->restoLikes = new ArrayCollection();
        $this->activiteLikes = new ArrayCollection();
        $this->campingLikes = new ArrayCollection();
        $this->blogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->getEmail();
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

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
            $comentaire->setUser($this);
        }

        return $this;
    }

    public function removeComentaire(Comentaire $comentaire): self
    {
        if ($this->comentaires->contains($comentaire)) {
            $this->comentaires->removeElement($comentaire);
            // set the owning side to null (unless already changed)
            if ($comentaire->getUser() === $this) {
                $comentaire->setUser(null);
            }
        }

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
            $like->setUser($this);
        }

        return $this;
    }

    public function removeLike(VilleLike $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getUser() === $this) {
                $like->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HotelLike[]
     */
    public function getHotelLikes(): Collection
    {
        return $this->hotelLikes;
    }

    public function addHotelLike(HotelLike $hotelLike): self
    {
        if (!$this->hotelLikes->contains($hotelLike)) {
            $this->hotelLikes[] = $hotelLike;
            $hotelLike->setUser($this);
        }

        return $this;
    }

    public function removeHotelLike(HotelLike $hotelLike): self
    {
        if ($this->hotelLikes->contains($hotelLike)) {
            $this->hotelLikes->removeElement($hotelLike);
            // set the owning side to null (unless already changed)
            if ($hotelLike->getUser() === $this) {
                $hotelLike->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RestoLike[]
     */
    public function getRestoLikes(): Collection
    {
        return $this->restoLikes;
    }

    public function addRestoLike(RestoLike $restoLike): self
    {
        if (!$this->restoLikes->contains($restoLike)) {
            $this->restoLikes[] = $restoLike;
            $restoLike->setUser($this);
        }

        return $this;
    }

    public function removeRestoLike(RestoLike $restoLike): self
    {
        if ($this->restoLikes->contains($restoLike)) {
            $this->restoLikes->removeElement($restoLike);
            // set the owning side to null (unless already changed)
            if ($restoLike->getUser() === $this) {
                $restoLike->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ActiviteLike[]
     */
    public function getActiviteLikes(): Collection
    {
        return $this->activiteLikes;
    }

    public function addActiviteLike(ActiviteLike $activiteLike): self
    {
        if (!$this->activiteLikes->contains($activiteLike)) {
            $this->activiteLikes[] = $activiteLike;
            $activiteLike->setUser($this);
        }

        return $this;
    }

    public function removeActiviteLike(ActiviteLike $activiteLike): self
    {
        if ($this->activiteLikes->contains($activiteLike)) {
            $this->activiteLikes->removeElement($activiteLike);
            // set the owning side to null (unless already changed)
            if ($activiteLike->getUser() === $this) {
                $activiteLike->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CampingLike[]
     */
    public function getCampingLikes(): Collection
    {
        return $this->campingLikes;
    }

    public function addCampingLike(CampingLike $campingLike): self
    {
        if (!$this->campingLikes->contains($campingLike)) {
            $this->campingLikes[] = $campingLike;
            $campingLike->setUser($this);
        }

        return $this;
    }

    public function removeCampingLike(CampingLike $campingLike): self
    {
        if ($this->campingLikes->contains($campingLike)) {
            $this->campingLikes->removeElement($campingLike);
            // set the owning side to null (unless already changed)
            if ($campingLike->getUser() === $this) {
                $campingLike->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Blog[]
     */
    public function getBlogs(): Collection
    {
        return $this->blogs;
    }

    public function addBlog(Blog $blog): self
    {
        if (!$this->blogs->contains($blog)) {
            $this->blogs[] = $blog;
            $blog->setUser($this);
        }

        return $this;
    }

    public function removeBlog(Blog $blog): self
    {
        if ($this->blogs->contains($blog)) {
            $this->blogs->removeElement($blog);
            // set the owning side to null (unless already changed)
            if ($blog->getUser() === $this) {
                $blog->setUser(null);
            }
        }

        return $this;
    }
}
