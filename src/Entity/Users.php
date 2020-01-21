<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use OpenApi\Annotations as OA;



/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @OA\Schema(schema="users", required={"id", "role", "name", "created_at", "updated_at", "adress", "password", "token", "mail", "is_enable", "user_bin"})
 */
class Users
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
     * @ORM\Column(type="string")
     * @OA\Property(type="string")
     */
    private $user_id;

    /**
     * @ORM\Column(type="datetime")
     * @OA\Property(type="string", format="date-time")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @OA\Property(type="string", format="date-time", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255)
     * @OA\Property(type="string", maxLength=255)
     */
    private $token;

    /**
     * @ORM\Column(type="boolean")
     * @OA\Property(type="boolean")
     */
    private $is_enable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsersBin", mappedBy="uuid_user")
     * @OA\Property(type="integer")
     */
    private $user_bin;

    public function __construct()
    {
        $this->user_bin = new ArrayCollection();
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

    public function getUser_id(): ?string
    {
        return $this->user_id;
    }


    public function setUserId($user_id): self
    {
        $this->user_id = $user_id;
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



    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

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
            $userBin->setUuidUser($this);
        }

        return $this;
    }

    public function removeUserBin(UsersBin $userBin): self
    {
        if ($this->user_bin->contains($userBin)) {
            $this->user_bin->removeElement($userBin);
            // set the owning side to null (unless already changed)
            if ($userBin->getUuidUser() === $this) {
                $userBin->setUuidUser(null);
            }
        }

        return $this;
    }
}
