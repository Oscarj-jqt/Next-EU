<?php

namespace App\Rule;

use App\Entity\QuizQuestion;
use Doctrine\ORM\EntityManagerInterface;

class IsQuizAnswerCorrectRule
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function applies(int $quizId, string $answer): bool
    {
        $quiz = $this->entityManager->getRepository(QuizQuestion::class)->find($quizId);

        return in_array($answer, $quiz->getCorrectAnswerOptions());
    }
}
