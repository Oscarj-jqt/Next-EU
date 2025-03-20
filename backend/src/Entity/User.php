<?php

namespace App\Entity;

use App\Enum\CountryEnum;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements \Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255, unique: true)]
    private string $username;

    #[ORM\Column(length: 255)]
    private string $password;

    #[ORM\Column(enumType: CountryEnum::class)]
    private CountryEnum $country;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profilePicture = null;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    /**
     * @var Collection<int, Video>
     */
    #[ORM\OneToMany(targetEntity: Video::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $uploadedVideos;

    /**
     * @var Collection<int, Video>
     */
    #[ORM\ManyToMany(targetEntity: Video::class, mappedBy: 'ratedByUsers')]
    private Collection $ratedVideos;

    public function __construct()
    {
        $this->uploadedVideos = new ArrayCollection();
        $this->ratedVideos = new ArrayCollection();
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

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getCountry(): CountryEnum
    {
        return $this->country;
    }

    public function setCountry(CountryEnum $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): static
    {
        $this->profilePicture = $profilePicture;

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

    /**
     * @return Collection<int, Video>
     */
    public function getUploadedVideos(): Collection
    {
        return $this->uploadedVideos;
    }

    /**
     * @param Collection<int, Video> $uploadedVideos
     */
    public function setUploadedVideos(Collection $uploadedVideos): self
    {
        $this->uploadedVideos = $uploadedVideos;

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getRatedVideos(): Collection
    {
        return $this->ratedVideos;
    }

    /**
     * @param Collection<int, Video> $ratedVideos
     */
    public function setRatedVideos(Collection $ratedVideos): self
    {
        $this->ratedVideos = $ratedVideos;

        return $this;
    }
}
