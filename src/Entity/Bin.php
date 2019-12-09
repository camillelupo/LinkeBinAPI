<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BinRepository")
 */
class Bin
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $lat;

    /**
     * @ORM\Column(type="float")
     */
    private $lon;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_enable;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsersBin", mappedBy="uuid_bin")
     */
    private $user_bin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BinHistoric", mappedBy="uuid_bin")
     */
    private $bin_historics;

    public function __construct()
    {
        $this->user_bin = new ArrayCollection();
        $this->bin_historics = new ArrayCollection();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?float
    {
        return $this->lon;
    }

    public function setLon(float $lon): self
    {
        $this->lon = $lon;

        return $this;
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
}
