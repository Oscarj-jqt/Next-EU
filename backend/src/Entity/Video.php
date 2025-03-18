<?php

/** @phpstan-ignore-file */

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thumbnail = null;

    #[ORM\Column]
    private ?int $views = null;

    #[ORM\Column(length: 100)]
    private ?string $country = null;

    #[ORM\Column(length: 100)]
    private ?string $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $google_maps_url = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    // Relation with User entity
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'uploadedVideos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    // Relation with ratings and saving videos
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'savedVideos')]
    #[ORM\JoinTable(name: 'video_saved')]
    private Collection $savedByUsers;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'ratedVideos')]
    #[ORM\JoinTable(name: 'video_ratings')]
    private Collection $ratedByUsers;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): static
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(int $views): static
    {
        $this->views = $views;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getGoogleMapsUrl(): ?string
    {
        return $this->google_maps_url;
    }

    public function setGoogleMapsUrl(?string $google_maps_url): static
    {
        $this->google_maps_url = $google_maps_url;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSavedByUsers(): Collection
    {
        return $this->savedByUsers;
    }

    public function setSavedByUsers(Collection $savedByUsers): self
    {
        $this->savedByUsers = $savedByUsers;

        return $this;
    }

    public function getRatedByUsers(): Collection
    {
        return $this->ratedByUsers;
    }

    public function setRatedByUsers(Collection $ratedByUsers): self
    {
        $this->ratedByUsers = $ratedByUsers;

        return $this;
    }

}
