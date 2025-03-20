<?php

namespace App\Entity;

use App\Repository\ChallengeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChallengeRepository::class)]
class Challenge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(length: 255)]
    private string $description;

    /**
     * @var Collection<int, Video>
     */
    #[ORM\OneToMany(targetEntity: Video::class, mappedBy: 'challenge', cascade: ['persist', 'remove'])]
    private Collection $videosOfChallenge;

    #[ORM\Column]
    private \DateTimeImmutable $validUntil;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    /**
     * @param Collection<int, Video>|null $videosOfChallenge
     */
    public function __construct(
        string $title,
        string $description,
        \DateTimeImmutable $validUntil,
        ?Collection $videosOfChallenge = null,
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->validUntil = $validUntil;
        $this->createdAt = new \DateTimeImmutable();
        $this->videosOfChallenge = $videosOfChallenge ?? new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideosOfChallenge(): Collection
    {
        return $this->videosOfChallenge;
    }

    /**
     * @param Collection<int, Video> $videosOfChallenge
     */
    public function setVideosOfChallenge(Collection $videosOfChallenge): static
    {
        $this->videosOfChallenge = $videosOfChallenge;

        return $this;
    }

    public function getValidUntil(): \DateTimeImmutable
    {
        return $this->validUntil;
    }

    public function setValidUntil(\DateTimeImmutable $validUntil): static
    {
        $this->validUntil = $validUntil;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
