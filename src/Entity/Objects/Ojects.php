<?php

namespace App\Entity\Objects;

use App\Entity\Objects\Metadata\Floor;
use App\Repository\Objects\OjectsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OjectsRepository::class)
 */
class Ojects
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Floor::class, inversedBy="ojects")
     */
    private $floor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFloor(): ?Floor
    {
        return $this->floor;
    }

    public function setFloor(?Floor $floor): self
    {
        $this->floor = $floor;

        return $this;
    }
}
