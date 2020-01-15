<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use OpenApi\Annotations as OA;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BinHistoricRepository")
 * @OA\Schema(schema="bin_historic", required={"id", "uuid_bin", "created_at", "pickup_at", "empty"})
 */
class BinHistoric
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Bin", inversedBy="bin_historics")
     * @ORM\JoinColumn(nullable=false)
     * @OA\Property(type="integer")
     */
    private $uuid_bin;

    /**
     * @ORM\Column(type="datetime")
     * @OA\Property(type="string", format="date-time")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @OA\Property(type="string", format="date-time")
     */
    private $pickup_date;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @OA\Property(type="boolean", nullable=true)
     */
    private $empty;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPickupDate(): ?\DateTimeInterface
    {
        return $this->pickup_date;
    }

    public function setPickupDate(?\DateTimeInterface $pickup_date): self
    {
        $this->pickup_date = $pickup_date;

        return $this;
    }

    public function getEmpty(): ?bool
    {
        return $this->empty;
    }

    public function setEmpty(?bool $empty): self
    {
        $this->empty = $empty;

        return $this;
    }
}
