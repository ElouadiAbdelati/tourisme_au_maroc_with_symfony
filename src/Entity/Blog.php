<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass=BlogRepository::class)
 * @Vich\Uploadable
 */
class Blog
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
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="blogs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=CommentaireBlog::class, mappedBy="blog")
     */
    private $commentaireBlogs;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, mappedBy="blogs")
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="blogs")
     */
    private $categorie;
    

    /**
     * @Vich\UploadableField(mapping="blog_path", fileNameProperty="image")
     * @var File
     */
    private $imgPathFile;
     /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    

    public function __construct()
    {
        $this->commentaireBlogs = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|CommentaireBlog[]
     */
    public function getCommentaireBlogs(): Collection
    {
        return $this->commentaireBlogs;
    }

    public function addCommentaireBlog(CommentaireBlog $commentaireBlog): self
    {
        if (!$this->commentaireBlogs->contains($commentaireBlog)) {
            $this->commentaireBlogs[] = $commentaireBlog;
            $commentaireBlog->setBlog($this);
        }

        return $this;
    }

    public function removeCommentaireBlog(CommentaireBlog $commentaireBlog): self
    {
        if ($this->commentaireBlogs->contains($commentaireBlog)) {
            $this->commentaireBlogs->removeElement($commentaireBlog);
            // set the owning side to null (unless already changed)
            if ($commentaireBlog->getBlog() === $this) {
                $commentaireBlog->setBlog(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addBlog($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removeBlog($this);
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

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

    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->getContent();
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
}
