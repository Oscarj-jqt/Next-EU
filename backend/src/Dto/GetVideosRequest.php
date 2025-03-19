<?php

namespace App\Dto;

use App\Enum\CategoryEnum;
use App\Enum\CountryEnum;
use Symfony\Component\Validator\Constraints as Assert;

class GetVideosRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'Category is required')]
        #[Assert\Choice(choices: CategoryEnum::VALUES)]
        public string $category,

        #[Assert\NotBlank(message: 'Country is required')]
        #[Assert\Choice(choices: CountryEnum::VALUES)]
        public string $country,

        #[Assert\NotBlank(message: 'User ID is required')]
        public int $userId,

        #[Assert\PositiveOrZero(message: 'Views must be zero or positive')]
        public ?int $views = null,

        #[Assert\Length(max: 255)]
        public ?string $title = null,

        public ?\DateTimeImmutable $createdAtFrom = null,
        public ?\DateTimeImmutable $createdAtTo = null
    ) {
    }

    public function getCategory(): CategoryEnum
    {
        return CategoryEnum::from($this->category);
    }

    public function getCountry(): CountryEnum
    {
        return CountryEnum::from($this->country);
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getCreatedAtFrom(): ?\DateTimeImmutable
    {
        return $this->createdAtFrom;
    }

    public function getCreatedAtTo(): ?\DateTimeImmutable
    {
        return $this->createdAtTo;
    }
}
