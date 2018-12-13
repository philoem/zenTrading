<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Serializable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @UniqueEntity(fields= {"mail"}, message= "L'email que vous avez indiqué est déjà utilisé !!")
 * 
 */
class Users implements UserInterface, \Serializable

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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\Valid
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email
     */
    private $mail;

    /**
    * @ORM\Column(name="locations", type="string", length=80, nullable=true)
    */
    private $locations;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire minimum 8 caractères")
     * @Assert\EqualTo(propertyPath="confirm_password")
     */
    private $password;

    /**
     * 
     * @Assert\EqualTo(propertyPath="password", message="Votre mot de passe doit être identique à celui du champs d'avant")
     * 
     */
    private $confirm_password;

    /**
    * @ORM\Column(name="salt", type="string", length=255, nullable=true)
    */
    private $salt;
    /**
    * @ORM\Column(name="roles", type="array", nullable=true)
    * 
    */
    private $roles = [];

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="user")
     */
    private $comments;

    /**
    * Constructor
    */
    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->comments = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getLocations(): ?string
    {
        return $this->locations;
    }

    public function setLocations(string $locations): self
    {
        $this->locations = $locations;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirm_password;
    }

    public function setConfirmPassword(string $confirm_password): self
    {
        $this->confirm_password = $confirm_password;

        return $this;
    }


    /**
    * Get the value of salt
    */ 
    public function getSalt(): ? string
    {
        return $this->salt;
    }
    /**
    * Set the value of salt
    *
    * @return  self
    */ 
    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    /**
    * Get the value of roles
    */ 
    public function getRoles(): array
    {
        $roles = $this->roles;
        if(empty($roles)){
            $roles[] = 'ROLE_USER';
        }
        return array_unique($roles);
    }
    /**
    * Set the value of roles
    *
    * @return  self
    */ 
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    public function eraseCredentials(): void
    {
    }

    // serialize and unserialize must be updated - see below
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->name,                       
            $this->username,
            $this->mail,
            $this->password,
            $this->roles
        ));
    }
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->name,                       
            $this->username,
            $this->mail,
            $this->password,
            $this->roles,
        ) = unserialize($serialized);
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }
}
