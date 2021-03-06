<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Openapi\Annotations as OA;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BinRepository")
 * @OA\Schema(schema="bin", required={"id", "coords", "city", "adress", "is_enable", "created_at", "updated_at", "user_bin", "bin_historics", "cityBins"})
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
     * @OA\Property(type="integer")
     */
    private $coords;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     * @OA\Property(type="string", maxLength=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     * @OA\Property(type="string", maxLength=255, nullable=true)
     */
    private $adress;


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
     * @OA\Property(type="integer",format="int32")
     */
    private $bin_historics;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CityBin", mappedBy="uuid_bin")
     * @var int
     * @OA\Property(type="integer",format="int32")
     */
    private $cityBins;

    public function __construct()
    {
        $this->user_bin = new ArrayCollection();
        $this->bin_historics = new ArrayCollection();
        $this->cityBins = new ArrayCollection();
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


    public function getCoords()
    {
        return $this->coords;
    }


    public function setCoords($coords): self
    {
        $this->coords = $coords;
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


    public function getCity(): ?string
    {
        return $this->city;
    }


    public function setCity($city): self
    {
        $this->city = $city;
        return $this;
    }


    public function getAdress(): ?string
    {
        return $this->adress;
    }


    public function setAdress($adress): self
    {
        $this->adress = $adress;
        return $this;
    }

    /**
     * @return Collection|UsersBin[]
     */
    public function getUserBin(): Collection
    {
        return $this->user_bin;
    }

    /**
     * @OA\Post(
     *    path="/AddUserBin",
     *    summary="Add userbin",
     *    operationId="add userbin",
     *    tags={"bin"},
     *    @OA\Parameter(
     *         name="userbin",
     *         in="path",
     *         description="object userbin",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/usersbin")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/usersbin")
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
    public function addUserBin(UsersBin $userBin): self
    {
        if (!$this->user_bin->contains($userBin)) {
            $this->user_bin[] = $userBin;
            $userBin->setUuidBin($this);
        }

        return $this;
    }

    /**
     * @OA\Delete(
     *    path="/RemoveUserBin",
     *    summary="delete userbin",
     *    operationId="delete userbin",
     *    tags={"bin"},
     *    @OA\Parameter(
     *         name="userbin",
     *         in="path",
     *         description="object userbin",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/usersbin")
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

    /**
     * @OA\Post(
     *    path="/AddBinHistoric",
     *    summary="Add binhistoric",
     *    operationId="add binhistoric",
     *    tags={"bin"},
     *    @OA\Parameter(
     *         name="binhistoric",
     *         in="path",
     *         description="object binhistoric",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/binhistoric")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/binhistoric")
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
    public function addBinHistoric(BinHistoric $binHistoric): self
    {
        if (!$this->bin_historics->contains($binHistoric)) {
            $this->bin_historics[] = $binHistoric;
            $binHistoric->setUuidBin($this);
        }

        return $this;
    }

    /**
     * @OA\Delete(
     *    path="/RemoveBinHistoric",
     *    summary="delete binhistoric",
     *    operationId="delete binhistoric",
     *    tags={"bin"},
     *    @OA\Parameter(
     *         name="binhistoric",
     *         in="path",
     *         description="object binhistoric",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/binhistoric")
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

    /**
     * @OA\Post(
     *    path="/AddCityBin",
     *    summary="Add user for citybin",
     *    operationId="add citybin",
     *    tags={"bin"},
     *    @OA\Parameter(
     *         name="citybin",
     *         in="path",
     *         description="object citybin",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/citybin")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/citybin")
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
    public function addCityBin(CityBin $cityBin): self
    {
        if (!$this->cityBins->contains($cityBin)) {
            $this->cityBins[] = $cityBin;
            $cityBin->setUuidBin($this);
        }

        return $this;
    }

    /**
     * @OA\Delete(
     *    path="/RemoveCityBin",
     *    summary="delete citybin",
     *    operationId="delete citybin",
     *    tags={"bin"},
     *    @OA\Parameter(
     *         name="citybin",
     *         in="path",
     *         description="object citybin",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/citybin")
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
