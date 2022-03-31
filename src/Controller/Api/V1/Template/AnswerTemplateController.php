<?php

namespace App\Controller\Api\V1\Template;

use App\Entity\Template\AnswerTemplate;
use App\Manager\Template\AnswerTemplateManager;
use App\Repository\Template\QuestionTemplateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/v1/answer-templates')]
final class AnswerTemplateController extends AbstractController
{
    public function __construct(
        private QuestionTemplateRepository $questionTemplateRepository,
        private AnswerTemplateManager $answerTemplateManager,
    ) {}

    #[Route(methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $answerTemplate = new AnswerTemplate(
            $this->questionTemplateRepository->find($request->request->get('questionTemplateId')),
            $request->request->get('text'),
            (bool) $request->request->get('isRight'),
        );

        $this->answerTemplateManager->save($answerTemplate);

        return new JsonResponse($answerTemplate, Response::HTTP_CREATED);
    }
}
