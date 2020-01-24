<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use OpenApi\Annotations as OA;



/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersBinRepository")
 * @OA\Schema(schema="usersbin", required={"id", "uuid_bin", "uuid_user", "created_at", "report_full", "reportHistoric"})
 */
class UsersBin
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Bin", inversedBy="user_bin")
     * @ORM\JoinColumn(nullable=false)
     * @OA\Property(type="integer", nullable=false)
     */
    private $uuid_bin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="user_bin")
     * @ORM\JoinColumn(nullable=false)
     * @OA\Property(type="integer", nullable=false)
     */
    private $uuid_user;

    /**
     * @ORM\Column(type="datetime")
     * @OA\Property(type="string", format="date-time")
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @OA\Property(type="boolean", nullable=true)
     */
    private $report_full;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReportHistoric", mappedBy="uuid_users_bin")
     * @OA\Property(type="integer")
     */
    private $reportHistoric;

    public function __construct()
    {
        $this->reportHistoric = new ArrayCollection();
        try {
            $this->id = Uuid::uuid4();
        } catch (\Exception $e) {
        }
        try {
            $this->created_at = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
        } catch (\Exception $e) {
        }
    }

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

    /**
     * @OA\Post(
     *    path="/AddReportHistoric",
     *    summary="Add reporthistoric",
     *    operationId="add reporthistoric",
     *    tags={"userbin"},
     *    @OA\Parameter(
     *         name="reporthistoric",
     *         in="path",
     *         description="object reporthistoric",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/reporthistoric")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/reporthistoric")
     *      ),
     *    @OA\Response(
     *          response=403,
     *     description="Access denied"
     *    ),
     *    @OA\Response(
     *     response=404,
     *     description="Not found"
     *    )
     * )
     */
    public function addReportHistoric(ReportHistoric $reportHistoric): self
    {
        if (!$this->reportHistoric->contains($reportHistoric)) {
            $this->reportHistoric[] = $reportHistoric;
            $reportHistoric->setUuidUsersBin($this);
        }

        return $this;
    }

    /**
     * @OA\Delete(
     *    path="/RemoveReportHistoric",
     *    summary="delete reporthistoric",
     *    operationId="delete reporthistoric",
     *    tags={"userbin"},
     *    @OA\Parameter(
     *         name="reporthistoric",
     *         in="path",
     *         description="object reporthistoric",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/reporthistoric")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="All have been deleted"
     *      ),
     *    @OA\Response(
     *          response=403,
     *     description="Access denied"
     *    ),
     *    @OA\Response(
     *     response=404,
     *     description="Not found"
     *    )
     * )
     */
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
