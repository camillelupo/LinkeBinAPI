<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use OpenApi\Annotations as OA;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityBinRepository")
 * @OA\Schema(schema="citybin", required={"id", "uuid_bin", "uuid_city"})
 */
class CityBin
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Bin", inversedBy="cityBins")
     * @ORM\JoinColumn(nullable=false)
     * @OA\Property(type="integer")
     */
    private $uuid_bin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="cityBins")
     * @ORM\JoinColumn(nullable=false)
     * @OA\Property(type="integer")
     */
    private $uuid_city;

    public function getId()
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
