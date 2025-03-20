<?php

namespace App\Dto;

use App\Enum\CountryEnum;
use Symfony\Component\Validator\Constraints as Assert;

readonly class GetRankRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'Country is required')]
        #[Assert\Choice(choices: CountryEnum::VALUES)]
        public string $country,
    ) {
    }

    public function getCountry(): CountryEnum
    {
        return CountryEnum::from($this->country);
    }
}
