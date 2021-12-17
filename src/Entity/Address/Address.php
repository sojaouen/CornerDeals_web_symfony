<?php

namespace App\Entity\Address;

use App\Repository\Address\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $streetNumber;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $streetNumberExtension;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $streetType;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $streetName;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $building;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $establishment;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $floor;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $floorNumber;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $postalCodePrefix;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $postalCodeSuffix;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $cedex;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $postBoxCode;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $locality;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $adminitrativeAreaLevel1;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $adminitrativeAreaLevel2;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $adminitrativeAreaLevel3;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $adminitrativeAreaLevel4;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $adminitrativeAreaLevel5;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $altitude;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFlat;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasElevator;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(?string $streetNumber): self
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    public function getStreetNumberExtension(): ?string
    {
        return $this->streetNumberExtension;
    }

    public function setStreetNumberExtension(?string $streetNumberExtension): self
    {
        $this->streetNumberExtension = $streetNumberExtension;

        return $this;
    }

    public function getStreetType(): ?string
    {
        return $this->streetType;
    }

    public function setStreetType(?string $streetType): self
    {
        $this->streetType = $streetType;

        return $this;
    }

    public function getStreetName(): ?string
    {
        return $this->streetName;
    }

    public function setStreetName(?string $streetName): self
    {
        $this->streetName = $streetName;

        return $this;
    }

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function setBuilding(?string $building): self
    {
        $this->building = $building;

        return $this;
    }

    public function getEstablishment(): ?string
    {
        return $this->establishment;
    }

    public function setEstablishment(?string $establishment): self
    {
        $this->establishment = $establishment;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(?string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getFloorNumber(): ?string
    {
        return $this->floorNumber;
    }

    public function setFloorNumber(?string $floorNumber): self
    {
        $this->floorNumber = $floorNumber;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPostalCodePrefix(): ?string
    {
        return $this->postalCodePrefix;
    }

    public function setPostalCodePrefix(?string $postalCodePrefix): self
    {
        $this->postalCodePrefix = $postalCodePrefix;

        return $this;
    }

    public function getPostalCodeSuffix(): ?string
    {
        return $this->postalCodeSuffix;
    }

    public function setPostalCodeSuffix(?string $postalCodeSuffix): self
    {
        $this->postalCodeSuffix = $postalCodeSuffix;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCedex(): ?string
    {
        return $this->cedex;
    }

    public function setCedex(?string $cedex): self
    {
        $this->cedex = $cedex;

        return $this;
    }

    public function getPostBoxCode(): ?string
    {
        return $this->postBoxCode;
    }

    public function setPostBoxCode(?string $postBoxCode): self
    {
        $this->postBoxCode = $postBoxCode;

        return $this;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function setLocality(?string $locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    public function getAdminitrativeAreaLevel1(): ?string
    {
        return $this->adminitrativeAreaLevel1;
    }

    public function setAdminitrativeAreaLevel1(?string $adminitrativeAreaLevel1): self
    {
        $this->adminitrativeAreaLevel1 = $adminitrativeAreaLevel1;

        return $this;
    }

    public function getAdminitrativeAreaLevel2(): ?string
    {
        return $this->adminitrativeAreaLevel2;
    }

    public function setAdminitrativeAreaLevel2(?string $adminitrativeAreaLevel2): self
    {
        $this->adminitrativeAreaLevel2 = $adminitrativeAreaLevel2;

        return $this;
    }

    public function getAdminitrativeAreaLevel3(): ?string
    {
        return $this->adminitrativeAreaLevel3;
    }

    public function setAdminitrativeAreaLevel3(?string $adminitrativeAreaLevel3): self
    {
        $this->adminitrativeAreaLevel3 = $adminitrativeAreaLevel3;

        return $this;
    }

    public function getAdminitrativeAreaLevel4(): ?string
    {
        return $this->adminitrativeAreaLevel4;
    }

    public function setAdminitrativeAreaLevel4(?string $adminitrativeAreaLevel4): self
    {
        $this->adminitrativeAreaLevel4 = $adminitrativeAreaLevel4;

        return $this;
    }

    public function getAdminitrativeAreaLevel5(): ?string
    {
        return $this->adminitrativeAreaLevel5;
    }

    public function setAdminitrativeAreaLevel5(?string $adminitrativeAreaLevel5): self
    {
        $this->adminitrativeAreaLevel5 = $adminitrativeAreaLevel5;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getAltitude(): ?string
    {
        return $this->altitude;
    }

    public function setAltitude(?string $altitude): self
    {
        $this->altitude = $altitude;

        return $this;
    }

    public function getIsFlat(): ?bool
    {
        return $this->isFlat;
    }

    public function setIsFlat(bool $isFlat): self
    {
        $this->isFlat = $isFlat;

        return $this;
    }

    public function getHasElevator(): ?bool
    {
        return $this->hasElevator;
    }

    public function setHasElevator(bool $hasElevator): self
    {
        $this->hasElevator = $hasElevator;

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

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
