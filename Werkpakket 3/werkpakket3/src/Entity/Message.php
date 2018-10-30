<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
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
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $userid;

    /**
     * @ORM\Column(type="integer")
     */
    private $categoryid;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reaction", mappedBy="message")
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->categoryid;
    }

    /**
     * @param mixed $categoryid
     */
    public function setCategory($categoryid): void
    {
        $this->categoryid = $categoryid;
    }

    public function __toString()
    {
        return $this->getContent();
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
            $reaction->setMessage($this);
        }

        return $this;
    }

    public function removeReaction(Reaction $reaction): self
    {
        if ($this->reactions->contains($reaction)) {
            $this->reactions->removeElement($reaction);
            // set the owning side to null (unless already changed)
            if ($reaction->getMessage() === $this) {
                $reaction->setMessage(null);
            }
        }

        return $this;
    }


}
