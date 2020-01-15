<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use OpenApi\Annotations as OA;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReportHistoricRepository")
 * @OA\Schema(schema="reporthistoric", required={"id", "uuid_users_bin", "created_at", "degradation", "bin_full", "missing"})
 */
class ReportHistoric
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Usersbin", inversedBy="reportHistoric")
     * @ORM\JoinColumn(nullable=false)
     * @OA\Property(type="integer")
     */
    private $uuid_users_bin;

    /**
     * @ORM\Column(type="datetime")
     * @OA\Property(type="string", format="date-time")
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @OA\Property(type="boolean")
     */
    private $degradation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @OA\Property(type="boolean")
     */
    private $bin_full;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @OA\Property(type="boolean")
     */
    private $missing;

    public function getId(): \Ramsey\Uuid\UuidInterface
    {
        return $this->id;
    }

    public function getUuidUsersBin(): ?Usersbin
    {
        return $this->uuid_users_bin;
    }

    public function setUuidUsersBin(?Usersbin $uuid_users_bin): self
    {
        $this->uuid_users_bin = $uuid_users_bin;

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

    public function getDegradation(): ?bool
    {
        return $this->degradation;
    }

    public function setDegradation(?bool $degradation): self
    {
        $this->degradation = $degradation;

        return $this;
    }

    public function getBinFull(): ?bool
    {
        return $this->bin_full;
    }

    public function setBinFull(?bool $bin_full): self
    {
        $this->bin_full = $bin_full;

        return $this;
    }

    public function getMissing(): ?bool
    {
        return $this->missing;
    }

    public function setMissing(?bool $missing): self
    {
        $this->missing = $missing;

        return $this;
    }
}
