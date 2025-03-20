<?php

namespace App\Dto;

use App\Enum\CategoryEnum;
use App\Enum\CountryEnum;
use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateMessageRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'Category is required')]
        #[Assert\Choice(choices: CategoryEnum::VALUES)]
        public string $category,

        #[Assert\NotBlank(message: 'Content is required')]
        #[Assert\Length(
            max: 500,
            minMessage: 'Content must be at least 10 characters long',
            maxMessage: 'Content cannot exceed 500 characters'
        )]
        public string $content,

        #[Assert\NotBlank(message: 'Country is required')]
        #[Assert\Choice(choices: CountryEnum::VALUES)]
        public string $country,

        #[Assert\NotBlank(message: 'User ID is required')]
        public int $userId,
    ) {
    }

    public function getCategory(): CategoryEnum
    {
        return CategoryEnum::from($this->category);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCountry(): CountryEnum
    {
        return CountryEnum::from($this->country);
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
