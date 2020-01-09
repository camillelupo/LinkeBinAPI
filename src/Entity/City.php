<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 */
class City
{
    /**
     * @var Uuid
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $file_json = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $departement;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_enable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CityBin", mappedBy="uuid_city")
     */
    private $cityBins;

    public function __construct()
    {
        $this->cityBins = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFileJson(): ?array
    {
        return $this->file_json;
    }

    public function setFileJson(array $file_json): self
    {
        $this->file_json = $file_json;

        return $this;
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

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(?string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return Collection|CityBin[]
     */
    public function getCityBins(): Collection
    {
        return $this->cityBins;
    }

    public function addCityBin(CityBin $cityBin): self
    {
        if (!$this->cityBins->contains($cityBin)) {
            $this->cityBins[] = $cityBin;
            $cityBin->setUuidCity($this);
        }

        return $this;
    }

    public function removeCityBin(CityBin $cityBin): self
    {
        if ($this->cityBins->contains($cityBin)) {
            $this->cityBins->removeElement($cityBin);
            // set the owning side to null (unless already changed)
            if ($cityBin->getUuidCity() === $this) {
                $cityBin->setUuidCity(null);
            }
        }

        return $this;
    }
}
