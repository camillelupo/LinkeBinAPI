<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Openapi\Annotations as OA;


/**
 * @ORM\Entity(repositoryClass="App/Repository/BinRepository")
 * @OA\Schema(required={"id", "lat", "long", "is_enable", "created_at", "updated_at", "user_bin", "bin_historics", "cityBins"})
 */
class Bin
{
    /**
     * @var Uuid
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     * @OA\Property(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="geography", options={"geometry_type"="POINT"})
     * @var int
     * @OA\Property(format="int32")
     */
    private $lat;

    /**
     * @ORM\Column(type="geography", options={"geometry_type"="POINT"})
     * @var int
     * @OA\Property(format="int32")
     */
    private $lon;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean|null
     * @OA\Property(type="boolean", nullable=true)
     */
    private $is_enable;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTimeInterface
     * @OA\Property(type="string", format="date-time")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTimeInterface
     * @OA\Property(type="string", format="date-time")
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsersBin", mappedBy="uuid_bin")
     * @var int
     * @OA\Property(type="integer")
     */
    private $user_bin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BinHistoric", mappedBy="uuid_bin")
     * @var int
     * @OA\Property(format="int32")
     */
    private $bin_historics;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CityBin", mappedBy="uuid_bin")
     * @var int
     * @OA\Property(format="int32")
     */
    private $cityBins;

    public function __construct()
    {
        $this->user_bin = new ArrayCollection();
        $this->bin_historics = new ArrayCollection();
        $this->cityBins = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lat
     */
    public function setLat($lat): void
    {
        $this->lat = $lat;
    }

    /**
     * @return mixed
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @param mixed $lon
     */
    public function setLon($lon): void
    {
        $this->lon = $lon;
    }



    public function getIsEnable(): ?bool
    {
        return $this->is_enable;
    }

    public function setIsEnable(bool $is_enable): self
    {
        $this->is_enable = $is_enable;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|UsersBin[]
     */
    public function getUserBin(): Collection
    {
        return $this->user_bin;
    }

    public function addUserBin(UsersBin $userBin): self
    {
        if (!$this->user_bin->contains($userBin)) {
            $this->user_bin[] = $userBin;
            $userBin->setUuidBin($this);
        }

        return $this;
    }

    public function removeUserBin(UsersBin $userBin): self
    {
        if ($this->user_bin->contains($userBin)) {
            $this->user_bin->removeElement($userBin);
            // set the owning side to null (unless already changed)
            if ($userBin->getUuidBin() === $this) {
                $userBin->setUuidBin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BinHistoric[]
     */
    public function getBinHistorics(): Collection
    {
        return $this->bin_historics;
    }

    public function addBinHistoric(BinHistoric $binHistoric): self
    {
        if (!$this->bin_historics->contains($binHistoric)) {
            $this->bin_historics[] = $binHistoric;
            $binHistoric->setUuidBin($this);
        }

        return $this;
    }

    public function removeBinHistoric(BinHistoric $binHistoric): self
    {
        if ($this->bin_historics->contains($binHistoric)) {
            $this->bin_historics->removeElement($binHistoric);
            // set the owning side to null (unless already changed)
            if ($binHistoric->getUuidBin() === $this) {
                $binHistoric->setUuidBin(null);
            }
        }

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
            $cityBin->setUuidBin($this);
        }

        return $this;
    }

    public function removeCityBin(CityBin $cityBin): self
    {
        if ($this->cityBins->contains($cityBin)) {
            $this->cityBins->removeElement($cityBin);
            // set the owning side to null (unless already changed)
            if ($cityBin->getUuidBin() === $this) {
                $cityBin->setUuidBin(null);
            }
        }

        return $this;
    }
}
