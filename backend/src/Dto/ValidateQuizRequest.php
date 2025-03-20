<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

readonly class ValidateQuizRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'Quiz ID is required')]
        public int $quizId,

        #[Assert\NotBlank(message: 'User ID is required')]
        public int $userId,

        #[Assert\NotBlank(message: 'Answer is required')]
        public string $answer,
    ) {
    }

    public function getQuizId(): int
    {
        return $this->quizId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }
}
