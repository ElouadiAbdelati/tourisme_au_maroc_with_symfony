<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\column(type="string",length=255 )
     */
    private $too;
    /**
     * @ORM\column(type="string",length=255 )
     */
    private $frome;
    /**
     * @ORM\column(type="string",length=255 )
     */
    private $name;
    /**
     * @ORM\column(type="string",length=255 )
     */
    private $subject;
   
    /**
     * @ORM\column(type="string",length=255 )
     */
    private $cmessage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTo()
    {
        return $this->too;
    }

    public function setTo(String $too)
    {
        $this->too = $too;
    }
    public function getFrom()
    {
        return $this->frome;
    }
    public function setFrom(String $frome)
    {
        $this->frome = $frome;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName(String $name)
    {
        $this->name = $name;
    }
    public function getSubject()
    {
        return $this->subject;
    }
    public function setSubject(String $subject)
    {
        $this->subject = $subject;
    }
  
    public function getCmessage()
    {
        return $this->cmessage;
    }
    public function setCmessage(string $cmessage)
    {
        $this->cmessage = $cmessage;
    }
}
