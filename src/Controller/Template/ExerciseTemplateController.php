<?php

namespace App\Controller\Template;

use App\Repository\Template\ExerciseTemplateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/exercise-templates')]
final class ExerciseTemplateController extends AbstractController
{
    public function __construct(private ExerciseTemplateRepository $exerciseTemplateRepository) {}

    #[Route(path: '/{id}', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $exercise = $this->exerciseTemplateRepository->find($id);

        return new JsonResponse($exercise, $exercise !== null ? 200 : 404);
    }
}
