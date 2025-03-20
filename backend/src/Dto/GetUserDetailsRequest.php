<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

readonly class GetUserDetailsRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'Username is required')]
        public string $username,
    ) {
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}
