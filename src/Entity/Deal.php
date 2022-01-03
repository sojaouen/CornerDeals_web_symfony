<?php

namespace App\Entity;

use App\Repository\Deal\DealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre titre est trop court",
     *      maxMessage = "Votre titre est trop long"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="float", nullable=true)
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
     * @ORM\Column(type="string", length=255)
     */
    private $discountType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $discountCode;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $currencyType;

    /**
     * @ORM\Column(type="date")
     */
    private $startAt;

    /**
     * @ORM\Column(type="date")
     */
    private $endAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $shippingCost;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isFreeShipping;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isLocal;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $localities;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="deals")
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity=Merchant::class, inversedBy="deals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $merchant;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="deals")
     */
    private $products;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

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

    // TODO: Add relationship Merchant OK
    // TODO: Add relationship Product OK
    // TODO: Add relationship Category/group OK
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

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeInterface $endAt): self
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

    public function getLocalities(): ?string
    {
        return $this->localities;
    }

    public function setLocalities(string $localities): self
    {
        $this->localities = $localities;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function getMerchant(): ?Merchant
    {
        return $this->merchant;
    }

    public function setMerchant(?Merchant $merchant): self
    {
        $this->merchant = $merchant;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addDeal($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeDeal($this);
        }

        return $this;
    }
}
