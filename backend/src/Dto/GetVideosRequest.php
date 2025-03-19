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
}
