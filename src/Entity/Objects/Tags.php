<?php

namespace App\Entity\Objects;

use App\Repository\Objects\TagsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TagsRepository::class)
 */
class Tags
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("public")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Objects::class, mappedBy="tags")
     */
    private $objects;

    public function __construct()
    {
        $this->objects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Objects[]
     */
    public function getObjects(): Collection
    {
        return $this->objects;
    }

    public function addObject(Objects $object): self
    {
        if (!$this->objects->contains($object)) {
            $this->objects[] = $object;
            $object->addTag($this);
        }

        return $this;
    }

    public function removeObject(Objects $object): self
    {
        if ($this->objects->removeElement($object)) {
            $object->removeTag($this);
        }

        return $this;
    }

    public function __toString() {
        return $this->name;
    }
}
