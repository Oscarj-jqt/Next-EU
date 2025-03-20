<?php

namespace App\Entity;

use App\Repository\QuizConnectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizConnectionRepository::class)]
class QuizConnection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\OneToMany(targetEntity: QuizQuestion::class, mappedBy: 'quizAnswered')]
    private QuizQuestion $quizQuestion;

    #[ORM\OneToOne(targetEntity: User::class, inversedBy: 'answeredQuizQuestions')]
    private User $user;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    public function __construct(
        QuizQuestion $quizQuestion,
        User $user,
    ) {
        $this->quizQuestion = $quizQuestion;
        $this->user = $user;
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

    public function getQuizQuestion(): QuizQuestion
    {
        return $this->quizQuestion;
    }

    public function setQuizQuestion(QuizQuestion $quizQuestion): static
    {
        $this->quizQuestion = $quizQuestion;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

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

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }
}
