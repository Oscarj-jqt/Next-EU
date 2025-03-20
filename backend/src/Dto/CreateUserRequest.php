<?php

namespace App\Dto;

use App\Enum\CountryEnum;
use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateUserRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'Country is required')]
        #[Assert\Choice(choices: CountryEnum::VALUES)]
        public string $country,

        #[Assert\NotBlank(message: 'Username is required')]
        #[Assert\Length(min: 4, max: 255, minMessage: 'Username must be at least 4 characters', maxMessage: 'Username cannot exceed 255 characters')]
        public string $username,

        #[Assert\NotBlank(message: 'Password is required')]
        #[Assert\Length(min: 8, max: 255, minMessage: 'Password must be at least 8 characters', maxMessage: 'Password cannot exceed 255 characters')]
        public string $password,
    ) {
    }

    public function getCountry(): CountryEnum
    {
        return CountryEnum::from($this->country);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
