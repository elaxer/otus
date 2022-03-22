<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\CourseDateRange;
use App\Manager\CourseManager;
use App\Repository\CourseRepository;
use App\Repository\StudentRepository;
use App\Repository\Template\ExerciseTemplateRepository;
use App\Service\CourseService;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/courses')]
final class CourseController extends AbstractController
{
    public function __construct(private CourseManager $courseManager, private CourseRepository $courseRepository, private CourseService $courseService) {}

    #[Route(methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $course = new Course(
            $request->request->get('name'),
            new CourseDateRange(
                new DateTimeImmutable($request->request->get('courseStartDate')),
                new DateTimeImmutable($request->request->get('courseEndDate')),
            ),
        );

        $this->courseManager->save($course);

        return new JsonResponse($course);
    }

    #[Route(path: '/{id}', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        return new JsonResponse($this->courseRepository->find($id));
    }

    #[Route(methods: ['GET'])]
    public function getList(): JsonResponse
    {
        return new JsonResponse($this->courseRepository->findAll());
    }

    /**
     * Записать студента на курс
     */
    #[Route(path: '/{courseId}/students/{studentId}', methods: ['POST'])]
    public function registerStudent(int $courseId, int $studentId, StudentRepository $studentRepository): JsonResponse
    {
        $this->courseService->registerStudent($this->courseRepository->find($courseId), $studentRepository->find($studentId));

        return new JsonResponse(null, 204);
    }

    #[Route(path: '/{courseId}/exercises/{exerciseId}', methods: ['POST'])]
    public function addExerciseFromTemplate(
        int $courseId,
        int $exerciseId,
        ExerciseTemplateRepository $exerciseTemplateRepository,
    ): JsonResponse {
        $this->courseService->addExerciseFromTemplate(
            $this->courseRepository->find($courseId),
            $exerciseTemplateRepository->find($exerciseId),
        );

        return new JsonResponse(null, 204);
    }
}
