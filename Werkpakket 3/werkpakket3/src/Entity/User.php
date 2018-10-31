<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
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
    private $userName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rolesString;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reaction", mappedBy="user", orphanRemoval=true)
     */
    private $reactions;

    public function __construct()
    {
        $this->reactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

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

    public function getRolesString(): ?string
    {
        return $this->rolesString;
    }

    public function setRolesString(string $rolesString): self
    {
        $this->rolesString = $rolesString;

        return $this;
    }

    public function getRoles()
    {
        return preg_split("/[\s,]+/", $this->rolesString);
    }

    public function getUser()
    {
        $user = new User();
        $user->id = $this->id;
        $user->userName = $this->userName;
        $user->rolesString = $this->rolesString;
        $user->password = $this->password;

        return $user;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }

    public function serialize()
    {
        $user = array(
            $this->id,
            $this->userName,
            $this->password,
            $this->rolesString
        );

        return serialize($user);
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->userName,
            $this->password,
            $this->rolesString,
            ) = unserialize($serialized);
    }



    public function __toString()
    {
        return "Entity: User, Username: " . $this->userName;
    }

    /**
     * @return Collection|Reaction[]
     */
    public function getReactions(): Collection
    {
        return $this->reactions;
    }

    public function addReaction(Reaction $reaction): self
    {
        if (!$this->reactions->contains($reaction)) {
            $this->reactions[] = $reaction;
            $reaction->setUser($this);
        }

        return $this;
    }

    public function removeReaction(Reaction $reaction): self
    {
        if ($this->reactions->contains($reaction)) {
            $this->reactions->removeElement($reaction);
            // set the owning side to null (unless already changed)
            if ($reaction->getUser() === $this) {
                $reaction->setUser(null);
            }
        }

        return $this;
    }


}
