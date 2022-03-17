<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\TokenRepository;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;

#[ORM\Entity(repositoryClass: TokenRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => [
            Token::TOKEN_READ,
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
#[ApiFilter(SearchFilter::class, properties: ['id' => 'exact', 'symbol' => 'partial', 'color' => 'exact'])]
class Token
{
    const TOKEN_READ = "token:read";

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups([Token::TOKEN_READ])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups([Token::TOKEN_READ])]
    private $symbol;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups([Token::TOKEN_READ])]
    private $color;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([Token::TOKEN_READ])]
    private $logoUrl;

    #[ORM\Column(type: 'boolean')]
    #[Groups([Token::TOKEN_READ])]
    private $isActive;

    #[ORM\OneToMany(mappedBy: 'token', targetEntity: Rate::class, orphanRemoval: true)]
    private $rates;

    public function __construct()
    {
        $this->rates = new ArrayCollection();
        $this->isActive = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(?string $logoUrl): self
    {
        $this->logoUrl = $logoUrl;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection|Rate[]
     */
    public function getRates(): Collection
    {
        return $this->rates;
    }

    public function addRate(Rate $rate): self
    {
        if (!$this->rates->contains($rate)) {
            $this->rates[] = $rate;
            $rate->setToken($this);
        }

        return $this;
    }

    public function removeRate(Rate $rate): self
    {
        if ($this->rates->removeElement($rate)) {
            // set the owning side to null (unless already changed)
            if ($rate->getToken() === $this) {
                $rate->setToken(null);
            }
        }

        return $this;
    }
}
