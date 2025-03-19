<?php

namespace App\Entity;

use App\Enum\CountryEnum;
use App\Repository\QuizQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizQuestionRepository::class)]
class QuizQuestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question_url = null;

    #[ORM\Column(length: 255)]
    private string $questionContent;

    #[ORM\Column(enumType: CountryEnum::class)]
    private CountryEnum $country;

    /** @var array<string> $wrongAnswerOptions */
    #[ORM\Column]
    private array $wrongAnswerOptions = [];

    /** @var array<string> $correctAnswerOptions */
    #[ORM\Column]
    private array $correctAnswerOptions = [];

    #[ORM\ManyToOne(targetEntity: QuizConnection::class, inversedBy: 'quizQuestion')]
    #[ORM\JoinColumn]
    private QuizConnection $quizAnswered;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getQuestionUrl(): ?string
    {
        return $this->question_url;
    }

    public function setQuestionUrl(?string $question_url): static
    {
        $this->question_url = $question_url;

        return $this;
    }

    public function getQuestionContent(): string
    {
        return $this->questionContent;
    }

    public function setQuestionContent(string $questionContent): static
    {
        $this->questionContent = $questionContent;

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

    /**
     * @return string[]
     */
    public function getWrongAnswerOptions(): array
    {
        return $this->wrongAnswerOptions;
    }

    /**
     * @param array<string> $wrongAnswerOptions
     */
    public function setWrongAnswerOptions(array $wrongAnswerOptions): static
    {
        $this->wrongAnswerOptions = $wrongAnswerOptions;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getCorrectAnswerOptions(): array
    {
        return $this->correctAnswerOptions;
    }

    /**
     * @param array<string> $correctAnswerOptions
     */
    public function setCorrectAnswerOptions(array $correctAnswerOptions): static
    {
        $this->correctAnswerOptions = $correctAnswerOptions;

        return $this;
    }

    public function getQuizAnswered(): QuizConnection
    {
        return $this->quizAnswered;
    }

    public function setQuizAnswered(QuizConnection $quizAnswered): static
    {
        $this->quizAnswered = $quizAnswered;

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
}
