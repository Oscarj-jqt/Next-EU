<?php
namespace App\Dto;

use App\Enum\CategoryEnum;
use App\Enum\CountryEnum;
use Symfony\Component\Validator\Constraints as Assert;

class CreateVideoRequest
{
public function __construct(
#[Assert\NotBlank(message: 'Title is required')]
#[Assert\Length(
max: 255,
minMessage: 'Title must be at least 3 characters long',
maxMessage: 'Title cannot exceed 255 characters'
)]
public string $title,

#[Assert\NotBlank(message: 'Description is required')]
#[Assert\Length(
max: 1000,
minMessage: 'Description must be at least 10 characters long',
maxMessage: 'Description cannot exceed 1000 characters'
)]
public string $description,

#[Assert\NotBlank(message: 'Category is required')]
#[Assert\Choice(choices: CategoryEnum::VALUES)]
public string $category,

#[Assert\NotBlank(message: 'Country is required')]
#[Assert\Choice(choices: CountryEnum::VALUES)]
public string $country,

#[Assert\NotBlank(message: 'User ID is required')]
public int $userId,

#[Assert\NotBlank(message: 'Video URL is required')]
#[Assert\Url(message: 'Invalid URL format')]
public string $videoUrl,

#[Assert\Length(max: 255)]
public ?string $thumbnail = null,

#[Assert\Url(message: 'Invalid Google Maps URL')]
public ?string $googleMapsUrl = null
) {
}

public function getTitle(): string
{
return $this->title;
}

public function getDescription(): string
{
return $this->description;
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

public function getVideoUrl(): string
{
return $this->videoUrl;
}

public function getThumbnail(): ?string
{
return $this->thumbnail;
}

public function getGoogleMapsUrl(): ?string
{
return $this->googleMapsUrl;
}
}
