<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use OpenApi\Annotations as OA;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 * @OA\Schema(schema="city", required={"id", "file_json", "name", "region", "departement", "cityBins"})
 */
class City
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
     * @ORM\Column(type="json")
     * @OA\Property(type="array", @OA\Items(type="string"))
     */
    private $file_json = [];

    /**
     * @ORM\Column(type="string", length=255)
     * @OA\Property(type="string", maxLength=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @OA\Property(type="string", maxLength=255, nullable=true)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @OA\Property(type="string", maxLength=255, nullable=true)
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
     * @ORM\Column(type="boolean")
     */
    private $is_enable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CityBin", mappedBy="uuid_city")
     * @OA\Property(type="integer")
     */
    private $cityBins;

    public function __construct()
    {
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }


    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;
    }


    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }


    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;
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

    /**
     * @return Collection|CityBin[]
     */
    public function getCityBins(): Collection
    {
        return $this->cityBins;
    }

    /**
     * @OA\Post(
     *    path="/Addcitybin",
     *    summary="Add citybin",
     *    operationId="add citybin",
     *    tags={"city"},
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
            $cityBin->setUuidCity($this);
        }

        return $this;
    }

    /**
     * @OA\Delete(
     *    path="/Removecitybin",
     *    summary="delete citybin",
     *    operationId="delete citybin",
     *    tags={"city"},
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
            if ($cityBin->getUuidCity() === $this) {
                $cityBin->setUuidCity(null);
            }
        }

        return $this;
    }
}
