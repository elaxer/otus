<?php

namespace App\Controller\Template;

use App\Entity\Template\ExerciseTemplate;
use App\Manager\Template\ExerciseTemplateManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/exercise-templates')]
final class ExerciseTemplateController extends AbstractController
{
    public function __construct(private ExerciseTemplateManager $exerciseTemplateManager) {}

    #[Route(methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $exerciseTemplate = new ExerciseTemplate($request->request->get('name'), $request->request->get('timeToComplete'));

        $this->exerciseTemplateManager->save($exerciseTemplate);

        return new JsonResponse($exerciseTemplate, 201);
    }

    #[Route(path: '/{id}', methods: ['GET'])]
    public function get(ExerciseTemplate $exerciseTemplate): JsonResponse
    {
        return new JsonResponse($exerciseTemplate);
    }
}
