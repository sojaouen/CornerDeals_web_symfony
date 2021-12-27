<?php

namespace App\Entity;

use App\Repository\Deal\DealRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DealRepository::class)
 */
class Deal
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
    private $title;

    /**
     * @ORM\Column(type="float")
     */
    private $crossedOutPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $dealPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $discount;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="deals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $discountCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $discountType;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $currencyType;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $endAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $shippingCost;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFreeShipping;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $shippingCountry;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isLocal;

    /**
     * @ORM\Column(type="array")
     */
    private $localities = [];

    // TODO: Add Title - OK
    // TODO: Add Description - A faire
    // TODO: Add URL - A faire
    // TODO: Add NewPrice = dealPrice
    // TODO: Add UsualPrice = crossedOutPrice
    // TODO: Add DiscountCode =  A faire
    // TODO: Add DiscountType : enum('percent', 'numerary') = A faire
    // TODO: Add StartAt = A faire
    // TODO: Add EndAt = A faire
    
    // TODO: Add ShippingCost = A faire
    // TODO: Add IsFreeShipping = A faire
    // TODO: Add ShippingCountry = A faire

    // TODO: Add IsLocalDeal = A faire
    // TODO: Add Localities (collection) = A faire

    // TODO: discountUnity = OK

    // TODO: Add relationship Merchant
    // TODO: Add relationship Product
    // TODO: Add relationship Category/group
    // TODO: Add relationship Medias (collection)

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCrossedOutPrice(): ?float
    {
        return $this->crossedOutPrice;
    }

    public function setCrossedOutPrice(float $crossedOutPrice): self
    {
        $this->crossedOutPrice = $crossedOutPrice;

        return $this;
    }

    public function getDealPrice(): ?float
    {
        return $this->dealPrice;
    }

    public function setDealPrice(float $dealPrice): self
    {
        $this->dealPrice = $dealPrice;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getDiscountUnity(): ?string
    {
        return $this->discountUnity;
    }

    public function setDiscountUnity(string $discountUnity): self
    {
        $this->discountUnity = $discountUnity;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDiscountCode(): ?string
    {
        return $this->discountCode;
    }

    public function setDiscountCode(?string $discountCode): self
    {
        $this->discountCode = $discountCode;

        return $this;
    }

    public function getDiscountType(): ?string
    {
        return $this->discountType;
    }

    public function setDiscountType(string $discountType): self
    {
        $this->discountType = $discountType;

        return $this;
    }

    public function getCurrencyType(): ?string
    {
        return $this->currencyType;
    }

    public function setCurrencyType(string $currencyType): self
    {
        $this->currencyType = $currencyType;

        return $this;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeImmutable $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeImmutable $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getShippingCost(): ?float
    {
        return $this->shippingCost;
    }

    public function setShippingCost(?float $shippingCost): self
    {
        $this->shippingCost = $shippingCost;

        return $this;
    }

    public function getIsFreeShipping(): ?bool
    {
        return $this->isFreeShipping;
    }

    public function setIsFreeShipping(bool $isFreeShipping): self
    {
        $this->isFreeShipping = $isFreeShipping;

        return $this;
    }

    public function getShippingCountry(): ?string
    {
        return $this->shippingCountry;
    }

    public function setShippingCountry(string $shippingCountry): self
    {
        $this->shippingCountry = $shippingCountry;

        return $this;
    }

    public function getIsLocal(): ?bool
    {
        return $this->isLocal;
    }

    public function setIsLocal(bool $isLocal): self
    {
        $this->isLocal = $isLocal;

        return $this;
    }

    public function getLocalities(): ?array
    {
        return $this->localities;
    }

    public function setLocalities(array $localities): self
    {
        $this->localities = $localities;

        return $this;
    }
}
