<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersBinRepository")
 */
class UsersBin
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Bin", inversedBy="user_bin")
     * @ORM\JoinColumn(nullable=false)
     */
    private $uuid_bin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="user_bin")
     * @ORM\JoinColumn(nullable=false)
     */
    private $uuid_user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $report_full;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReportHistoric", mappedBy="uuid_users_bin")
     */
    private $reportHistoric;

    public function __construct()
    {
        $this->reportHistoric = new ArrayCollection();
    }

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

    public function getUuidUser(): ?Users
    {
        return $this->uuid_user;
    }

    public function setUuidUser(?Users $uuid_user): self
    {
        $this->uuid_user = $uuid_user;

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

    public function getReportFull(): ?bool
    {
        return $this->report_full;
    }

    public function setReportFull(?bool $report_full): self
    {
        $this->report_full = $report_full;

        return $this;
    }

    /**
     * @return Collection|ReportHistoric[]
     */
    public function getReportHistoric(): Collection
    {
        return $this->reportHistoric;
    }

    public function addReportHistoric(ReportHistoric $reportHistoric): self
    {
        if (!$this->reportHistoric->contains($reportHistoric)) {
            $this->reportHistoric[] = $reportHistoric;
            $reportHistoric->setUuidUsersBin($this);
        }

        return $this;
    }

    public function removeReportHistoric(ReportHistoric $reportHistoric): self
    {
        if ($this->reportHistoric->contains($reportHistoric)) {
            $this->reportHistoric->removeElement($reportHistoric);
            // set the owning side to null (unless already changed)
            if ($reportHistoric->getUuidUsersBin() === $this) {
                $reportHistoric->setUuidUsersBin(null);
            }
        }

        return $this;
    }
}
