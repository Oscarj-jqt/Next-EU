<?php

namespace App\Entity;

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
    /** @phpstan-ignore-next-line **/
    private int $id;

    #[ORM\Column(length: 255)]
    private string $username;

    #[ORM\Column(length: 255)]
    private string $password;

    #[ORM\Column(length: 255)]
    private string $country;

    #[ORM\Column(length: 255)]
    private string $profile_picture;

    #[ORM\Column]
    private \DateTimeImmutable $created_at;

    // Relation avec l'entité Video
    /**
     * @var Collection<int, Video>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Video::class, orphanRemoval: true)]
    private Collection $uploadedVideos;

    // Relation avec les vidéos notées et sauvegardées
    /**
     * @var Collection<int, Video>
     */
    #[ORM\ManyToMany(targetEntity: Video::class, mappedBy: 'savedByUsers')]
    private Collection $savedVideos;

    /**
     * @var Collection<int, Video>
     */
    #[ORM\ManyToMany(targetEntity: Video::class, mappedBy: 'ratedByUsers')]
    private Collection $ratedVideos;

    public function __construct()
    {
        $this->uploadedVideos = new ArrayCollection();
        $this->savedVideos = new ArrayCollection();
        $this->ratedVideos = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getProfilePicture(): string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(string $profile_picture): static
    {
        $this->profile_picture = $profile_picture;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

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
    public function getSavedVideos(): Collection
    {
        return $this->savedVideos;
    }

    /**
     * @param Collection<int, Video> $savedVideos
     */
    public function setSavedVideos(Collection $savedVideos): self
    {
        $this->savedVideos = $savedVideos;

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
