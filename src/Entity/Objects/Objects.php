<?php

namespace App\Entity\Objects;

use App\Entity\Objects\Metadata\Categories;
use App\Entity\Objects\Metadata\Gods;
use App\Entity\Objects\Metadata\Materials;
use App\Entity\Objects\Metadata\Origin;
use App\Entity\Objects\Metadata\Population;
use App\Entity\Objects\Metadata\State;
use App\Entity\Objects\Metadata\SubCategories;
use App\Entity\User\User;
use App\Repository\Objects\ObjectsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObjectsRepository::class)
 */
class Objects
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
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $era;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="objects", orphanRemoval=true, cascade={"persist"})
     */
    private $images;

//    /**
//     * @ORM\ManyToMany(targetEntity=Tags::class, inversedBy="objects", cascade={"persist"})
//     */
//    private $tags;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $historicDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $historicDetail;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentary;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarks;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $sizeHigh;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $sizeLength;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $sizeDepth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $stateCommentary;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isBasemented;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isRent;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isExposedTemp;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isExposedPerm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $showcaseCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shelf;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="objectsUpdated")
     */
    private $updatedBy;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $verificationDate;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="objects")
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity=SubCategories::class, inversedBy="objects")
     */
    private $subCategories;

    /**
     * @ORM\ManyToOne(targetEntity=Population::class, inversedBy="objects")
     */
    private $population;

    /**
     * @ORM\ManyToOne(targetEntity=Origin::class, inversedBy="objects")
     */
    private $origin;

    /**
     * @ORM\ManyToOne(targetEntity=Gods::class, inversedBy="objects")
     */
    private $gods;

    /**
     * @ORM\ManyToMany(targetEntity=Gods::class, inversedBy="objectsRelated")
     */
    private $relatedGods;

    /**
     * @ORM\ManyToMany(targetEntity=Materials::class, inversedBy="objects")
     */
    private $materials;

    /**
     * @ORM\ManyToOne(targetEntity=State::class, inversedBy="objects")
     */
    private $state;

    public function __construct()
    {
        $this->setUpdatedAt(new \DateTimeImmutable('now'));
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable('now'));
        }
        $this->images = new ArrayCollection();
//        $this->tags = new ArrayCollection();
$this->relatedGods = new ArrayCollection();
$this->materials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

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

    public function getEra(): ?string
    {
        return $this->era;
    }

    public function setEra(?string $era): self
    {
        $this->era = $era;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setObjects($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getObjects() === $this) {
                $image->setObjects(null);
            }
        }

        return $this;
    }

//    /**
//     * @return Collection|Tags[]
//     */
//    public function getTags(): Collection
//    {
//        return $this->tags;
//    }
//
//    public function addTag(Tags $tag): self
//    {
//        if (!$this->tags->contains($tag)) {
//            $this->tags[] = $tag;
//        }
//
//        return $this;
//    }
//
//    public function removeTag(Tags $tag): self
//    {
//        $this->tags->removeElement($tag);
//
//        return $this;
//    }

    public function getHistoricDate(): ?\DateTimeInterface
    {
        return $this->historicDate;
    }

    public function setHistoricDate(?\DateTimeInterface $historicDate): self
    {
        $this->historicDate = $historicDate;

        return $this;
    }

    public function getHistoricDetail(): ?string
    {
        return $this->historicDetail;
    }

    public function setHistoricDetail(?string $historicDetail): self
    {
        $this->historicDetail = $historicDetail;

        return $this;
    }

    public function getCommentary(): ?string
    {
        return $this->commentary;
    }

    public function setCommentary(?string $commentary): self
    {
        $this->commentary = $commentary;

        return $this;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(?string $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getSizeHigh(): ?float
    {
        return $this->sizeHigh;
    }

    public function setSizeHigh(?float $sizeHigh): self
    {
        $this->sizeHigh = $sizeHigh;

        return $this;
    }

    public function getSizeLength(): ?float
    {
        return $this->sizeLength;
    }

    public function setSizeLength(?float $sizeLength): self
    {
        $this->sizeLength = $sizeLength;

        return $this;
    }

    public function getSizeDepth(): ?float
    {
        return $this->sizeDepth;
    }

    public function setSizeDepth(?float $sizeDepth): self
    {
        $this->sizeDepth = $sizeDepth;

        return $this;
    }

    public function getStateCommentary(): ?string
    {
        return $this->stateCommentary;
    }

    public function setStateCommentary(?string $stateCommentary): self
    {
        $this->stateCommentary = $stateCommentary;

        return $this;
    }

    public function getIsBasemented(): ?bool
    {
        return $this->isBasemented;
    }

    public function setIsBasemented(?bool $isBasemented): self
    {
        $this->isBasemented = $isBasemented;

        return $this;
    }

    public function getIsRent(): ?bool
    {
        return $this->isRent;
    }

    public function setIsRent(?bool $isRent): self
    {
        $this->isRent = $isRent;

        return $this;
    }

    public function getIsExposedTemp(): ?bool
    {
        return $this->isExposedTemp;
    }

    public function setIsExposedTemp(?bool $isExposedTemp): self
    {
        $this->isExposedTemp = $isExposedTemp;

        return $this;
    }

    public function getIsExposedPerm(): ?bool
    {
        return $this->isExposedPerm;
    }

    public function setIsExposedPerm(?bool $isExposedPerm): self
    {
        $this->isExposedPerm = $isExposedPerm;

        return $this;
    }

    public function getShowcaseCode(): ?string
    {
        return $this->showcaseCode;
    }

    public function setShowcaseCode(?string $showcaseCode): self
    {
        $this->showcaseCode = $showcaseCode;

        return $this;
    }

    public function getShelf(): ?string
    {
        return $this->shelf;
    }

    public function setShelf(?string $shelf): self
    {
        $this->shelf = $shelf;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $UpdatedAt): self
    {
        $this->updatedAt = $UpdatedAt;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getVerificationDate(): ?\DateTimeInterface
    {
        return $this->verificationDate;
    }

    public function setVerificationDate(?\DateTimeInterface $verificationDate): self
    {
        $this->verificationDate = $verificationDate;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getSubCategories(): ?SubCategories
    {
        return $this->subCategories;
    }

    public function setSubCategories(?SubCategories $subCategories): self
    {
        $this->subCategories = $subCategories;

        return $this;
    }

    public function getPopulation(): ?Population
    {
        return $this->population;
    }

    public function setPopulation(?Population $population): self
    {
        $this->population = $population;

        return $this;
    }

    public function getOrigin(): ?Origin
    {
        return $this->origin;
    }

    public function setOrigin(?Origin $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getGods(): ?Gods
    {
        return $this->gods;
    }

    public function setGods(?Gods $gods): self
    {
        $this->gods = $gods;

        return $this;
    }

    /**
     * @return Collection<int, Gods>
     */
    public function getRelatedGods(): Collection
    {
        return $this->relatedGods;
    }

    public function addRelatedGod(Gods $relatedGod): self
    {
        if (!$this->relatedGods->contains($relatedGod)) {
            $this->relatedGods[] = $relatedGod;
        }

        return $this;
    }

    public function removeRelatedGod(Gods $relatedGod): self
    {
        $this->relatedGods->removeElement($relatedGod);

        return $this;
    }

    /**
     * @return Collection<int, Materials>
     */
    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    public function addMaterial(Materials $material): self
    {
        if (!$this->materials->contains($material)) {
            $this->materials[] = $material;
        }

        return $this;
    }

    public function removeMaterial(Materials $material): self
    {
        $this->materials->removeElement($material);

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        $this->state = $state;

        return $this;
    }
}
