<?php

namespace App\Controller;

use App\Dto\ValidateQuizRequest;
use App\Entity\User;
use App\Repository\QuizQuestionRepository;
use App\Rule\DecreaseQuizPointsRule;
use App\Rule\IncreaseQuizPointsRule;
use App\Rule\IsQuizAnswerCorrectRule;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class QuizController extends AbstractController
{
    private const QUIZ_SIZE = 1;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly QuizQuestionRepository $quizQuestionRepository,
        private readonly IsQuizAnswerCorrectRule $isQuizAnswerCorrectRule,
        private readonly DecreaseQuizPointsRule $decreaseQuizPointsRule,
        private readonly IncreaseQuizPointsRule $increaseQuizPointsRule,
    ) {
    }

    #[Route('/api/get-quiz-question', name: 'getQuizQuestion', methods: ['get'])]
    public function getQuizQuestion(): JsonResponse
    {
        return new JsonResponse(
            data: $this->quizQuestionRepository->findRandomQuestions(self::QUIZ_SIZE),
            status: JsonResponse::HTTP_OK
        );
    }

    #[Route('/api/validate-quiz-answer', name: 'validateQuizAnswer', methods: ['POST'])]
    public function validateQuizAnswer(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $validateQuizRequest = new ValidateQuizRequest(
            quizId: $data['quizId'],
            userId: $data['userId'],
            answer: $data['answer']
        );

        if (count($validator->validate($validateQuizRequest)) > 0) {
            return new JsonResponse(status: JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = $this->entityManager
            ->getRepository(User::class)
            ->find($validateQuizRequest->getUserId());

        if (!$user) {
            return new JsonResponse(
                data: ['message' => 'User not found'],
                status: JsonResponse::HTTP_NOT_FOUND
            );
        }

        $isQuizAnswerCorrectRule = $this->isQuizAnswerCorrectRule->applies(
            quizId: $validateQuizRequest->getQuizId(),
            answer: $validateQuizRequest->getAnswer()
        );

        if (!$isQuizAnswerCorrectRule) {
            $this->decreaseQuizPointsRule->apply(user: $user);

            return new JsonResponse(
                data: ['message' => 'Answer is incorrect'],
                status: JsonResponse::HTTP_OK
            );
        }

        $this->increaseQuizPointsRule->apply(user: $user);

        return new JsonResponse(status: JsonResponse::HTTP_OK);
    }
}
