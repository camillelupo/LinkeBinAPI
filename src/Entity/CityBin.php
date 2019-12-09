<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
/**
 * @ORM\Entity(repositoryClass="App\Repository\CityBinRepository")
 */
class CityBin
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Bin", inversedBy="cityBins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $uuid_bin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="cityBins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $uuid_city;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getUuidBin(): ?Bin
    {
        return $this->uuid_bin;
    }

    public function setUuidBin(?Bin $uuid_bin): self
    {
        $this->uuid_bin = $uuid_bin;

        return $this;
    }

    public function getUuidCity(): ?City
    {
        return $this->uuid_city;
    }

    public function setUuidCity(?City $uuid_city): self
    {
        $this->uuid_city = $uuid_city;

        return $this;
    }
}
