<?php

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
    private int $id;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thumbnail = null;

    #[ORM\Column]
    private int $views = 0;

    #[ORM\Column(length: 100)]
    private string $country;

    #[ORM\Column(length: 100)]
    private string $category;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $googleMapsUrl = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $videoUrl = null;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    // Relation with User entity
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'uploadedVideos')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    // Relation with ratings and saving videos
    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'savedVideos')]
    #[ORM\JoinTable(name: 'video_saved')]
    private Collection $savedByUsers;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'ratedVideos')]
    #[ORM\JoinTable(name: 'video_ratings')]
    private Collection $ratedByUsers;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): string
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

    public function getViews(): int
    {
        return $this->views;
    }

    public function setViews(int $views): static
    {
        $this->views = $views;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCategory(): string
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
        return $this->googleMapsUrl;
    }

    public function setGoogleMapsUrl(?string $googleMapsUrl): static
    {
        $this->googleMapsUrl = $googleMapsUrl;

        return $this;
    }

    public function getVideoUrl(): ?string
    {
        return $this->videoUrl;
    }

    public function setVideoUrl(?string $videoUrl): static
    {
        $this->videoUrl = $videoUrl;

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

    /**
     * @return Collection<int, User>
     */
    public function getSavedByUsers(): Collection
    {
        return $this->savedByUsers;
    }

    /**
     * @param Collection<int, User> $savedByUsers
     */
    public function setSavedByUsers(Collection $savedByUsers): self
    {
        $this->savedByUsers = $savedByUsers;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getRatedByUsers(): Collection
    {
        return $this->ratedByUsers;
    }

    /**
     * @param Collection<int, User> $ratedByUsers
     */
    public function setRatedByUsers(Collection $ratedByUsers): self
    {
        $this->ratedByUsers = $ratedByUsers;

        return $this;
    }
}
