<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ContractListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContractListRepository::class)]
#[ApiResource]
class ContractList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $userId = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?int $SKU = null;

    #[ORM\Column]
    private ?string $modificator = null;

    #[ORM\Column]
    private ?int $modificatorValue = null;

    public function __construct(
        int $id,
        int $userId,
        float $price,
        int $SKU,
        string $modificator,
        int $modificatorValue
    ){
        $this->id = $id;
        $this->userId = $userId;
        $this->price = $price;
        $this->SKU = $SKU;
        $this->modificator = $modificator;
        $this->modificatorValue = $modificatorValue;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getSKU(): ?int
    {
        return $this->SKU;
    }

    public function setSKU(int $SKU): static
    {
        $this->SKU = $SKU;

        return $this;
    }

    public function getModificator(): ?string
    {
        return $this->modificator;
    }

    public function setModificator(int $modificator): static
    {
        $this->modificator = $modificator;

        return $this;
    }

    public function getModificatorValue(): ?int
    {
        return $this->modificatorValue;
    }

    public function setModificatorValue(int $modificatorValue): static
    {
        $this->modificatorValue = $modificatorValue;

        return $this;
    }
}
