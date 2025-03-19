<?php

namespace App\Entity;

use App\Enum\CategoryEnum;
use App\Enum\CountryEnum;
use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /** @phpstan-ignore-next-line **/
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'createdMessages')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(length: 255)]
    private string $content;

    #[ORM\Column(enumType: CategoryEnum::class)]
    private CategoryEnum $category;

    #[ORM\Column(enumType: CountryEnum::class)]
    private CountryEnum $country;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCategory(): CategoryEnum
    {
        return $this->category;
    }

    public function setCategory(CategoryEnum $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getCountry(): CountryEnum
    {
        return $this->country;
    }

    public function setCountry(CountryEnum $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
