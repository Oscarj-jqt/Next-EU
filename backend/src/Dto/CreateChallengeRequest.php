<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateChallengeRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'validUntil is required')]
        public string $validUntil,

        #[Assert\NotBlank(message: 'title is required')]
        #[Assert\Length(min: 4, max: 255, minMessage: 'Username must be at least 4 characters', maxMessage: 'Username cannot exceed 255 characters')]
        public string $title,

        #[Assert\NotBlank(message: 'description is required')]
        #[Assert\Length(min: 8, max: 255, minMessage: 'Password must be at least 8 characters', maxMessage: 'Password cannot exceed 255 characters')]
        public string $description,
    ) {
    }

    public function getValidUntil(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d H:i', $this->validUntil);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
