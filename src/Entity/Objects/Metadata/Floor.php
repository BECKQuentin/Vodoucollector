<?php

namespace App\Entity\Objects\Metadata;

use App\Entity\Objects\Ojects;
use App\Repository\Objects\Metadata\FloorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FloorRepository::class)
 */
class Floor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Ojects::class, mappedBy="floor")
     */
    private $ojects;

    public function __construct()
    {
        $this->ojects = new ArrayCollection();
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
     * @return Collection<int, Ojects>
     */
    public function getOjects(): Collection
    {
        return $this->ojects;
    }

    public function addOject(Ojects $oject): self
    {
        if (!$this->ojects->contains($oject)) {
            $this->ojects[] = $oject;
            $oject->setFloor($this);
        }

        return $this;
    }

    public function removeOject(Ojects $oject): self
    {
        if ($this->ojects->removeElement($oject)) {
            // set the owning side to null (unless already changed)
            if ($oject->getFloor() === $this) {
                $oject->setFloor(null);
            }
        }

        return $this;
    }
}
