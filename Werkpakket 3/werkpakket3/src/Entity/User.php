<?php

namespace App\Entity;

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
            ) = $this->unserialize($serialized);
    }

    public function __toString()
    {
        return "Entity: User, Username: " . $this->userName;
    }


}
