<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $videoUrl;

    // Relation with User entity
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'uploadedVideos')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'ratedVideos')]
    #[ORM\JoinTable(name: 'video_ratings')]
    private Collection $ratedByUsers;

    #[ORM\ManyToOne(targetEntity: Challenge::class, inversedBy: 'videosOfChallenge')]
    private Challenge $challenge;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    public function __construct(
        string $videoUrl,
        User $user,
        Challenge $challenge,
    ) {
        $this->ratedByUsers = new ArrayCollection();
        $this->videoUrl = $videoUrl;
        $this->user = $user;
        $this->challenge = $challenge;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getVideoUrl(): string
    {
        return $this->videoUrl;
    }

    public function setVideoUrl(string $videoUrl): static
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

    public function getChallenge(): Challenge
    {
        return $this->challenge;
    }

    public function setChallenge(Challenge $challenge): self
    {
        $this->challenge = $challenge;

        return $this;
    }
}
