<?php

namespace App\Controller\Api\V1\Template;

use App\Entity\Template\QuestionTemplate;
use App\Manager\Template\QuestionTemplateManager;
use App\Repository\Template\ExerciseTemplateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/v1/question-templates')]
final class QuestionTemplateController extends AbstractController
{
    public function __construct(
        private ExerciseTemplateRepository $exerciseTemplateRepository,
        private QuestionTemplateManager $questionTemplateManager,
    ) {}

    #[Route(methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $questionTemplate = new QuestionTemplate(
            $this->exerciseTemplateRepository->find($request->request->get('exerciseTemplateId')),
            $request->request->get('text'),
        );

        $this->questionTemplateManager->save($questionTemplate);

        return new JsonResponse($questionTemplate, Response::HTTP_CREATED);
    }
}
