<?php

namespace App\Entity\Deal;

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
     * @ORM\Column(type="string", length=255)
     */
    private $discountUnity;

    // TODO: Add Title
    // TODO: Add Description
    // TODO: Add URL
    // TODO: Add NewPrice
    // TODO: Add UsualPrice
    // TODO: Add DiscountCode
    // TODO: Add DiscountType : enum('percent', 'numerary')
    // TODO: Add StartAt
    // TODO: Add EndAt
    
    // TODO: Add ShippingCost
    // TODO: Add IsFreeShipping
    // TODO: Add ShippingCountry

    // TODO: Add IsLocalDeal
    // TODO: Add Localities (collection)

    // TODO: discountUnity = 
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
}
