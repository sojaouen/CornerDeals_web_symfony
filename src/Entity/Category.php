<?php

namespace App\Entity;

use App\Repository\Category\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=7, options={"fixed" = true}, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $illustration;

    /**
     * @ORM\ManyToMany(targetEntity=Deal::class, mappedBy="categories")
     */
    private $deals;

    /**
     * @ORM\ManyToMany(targetEntity=DiscountCode::class, mappedBy="categories")
     */
    private $discountCodes;


    public function __construct()
    {
        $this->deals = new ArrayCollection();
        $this->discountCodes = new ArrayCollection();
    }

    // TODO: Add parent property OK

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(?string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }

    /**
     * @return Collection|deal[]
     */
    public function getDeals(): Collection
    {
        return $this->deals;
    }

    public function addDeal(deal $deal): self
    {
        if (!$this->deals->contains($deal)) {
            $this->deals[] = $deal;
            $deal->setCategory($this);
        }

        return $this;
    }

    public function removeDeal(deal $deal): self
    {
        if ($this->deals->removeElement($deal)) {
            // set the owning side to null (unless already changed)
            if ($deal->getCategory() === $this) {
                $deal->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DiscountCode[]
     */
    public function getDiscountCodes(): Collection
    {
        return $this->discountCodes;
    }

    public function addDiscountCode(DiscountCode $discountCode): self
    {
        if (!$this->discountCodes->contains($discountCode)) {
            $this->discountCodes[] = $discountCode;
            $discountCode->addCategory($this);
        }

        return $this;
    }

    public function removeDiscountCode(DiscountCode $discountCode): self
    {
        if ($this->discountCodes->removeElement($discountCode)) {
            $discountCode->removeCategory($this);
        }

        return $this;
    }
}
