<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RateRepository;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;

#[ORM\Entity(repositoryClass: RateRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => [
            Rate::RATE_READ,
        ],
    ],
    paginationEnabled: true,
    paginationItemsPerPage: 10,
    paginationClientItemsPerPage: true,
    itemOperations: [
        'get',
    ],
    collectionOperations: [
        'get',
    ],
)]
#[ApiFilter(SearchFilter::class, properties: ['id' => 'exact', 'value' => 'exact', 'token' => 'exact'])]
#[ApiFilter(DateFilter::class, properties: ['createdAt'])]
class Rate
{
    const RATE_READ = "rate:read";

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups([Rate::RATE_READ])]
    private $id;

    #[ORM\Column(type: 'float')]
    #[Groups([Rate::RATE_READ])]
    private $value;

    #[ORM\Column(type: 'datetime')]
    #[Groups([Rate::RATE_READ])]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: Token::class, inversedBy: 'rates')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([Rate::RATE_READ])]
    private $token;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getToken(): ?Token
    {
        return $this->token;
    }

    public function setToken(?Token $token): self
    {
        $this->token = $token;

        return $this;
    }
}
