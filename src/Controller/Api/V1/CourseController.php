<?php

namespace App\Controller\Api\V1;

use App\Entity\Course;
use App\Entity\CourseDateRange;
use App\Entity\Template\ExerciseTemplate;
use App\Manager\CourseManager;
use App\Repository\CourseRepository;
use App\Repository\StudentRepository;
use App\Service\CourseServiceInterface;
use DateTimeImmutable;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/v1/courses')]
final class CourseController extends AbstractController
{
    public function __construct(
        private CourseManager $courseManager,
        private CourseRepository $courseRepository,
        private CourseServiceInterface $courseService
    ) {}

    /**
     * @throws \Exception
     */
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

        return new JsonResponse($course, 201);
    }

    #[Route(path: '/{id}', methods: ['GET'])]
    public function get(Course $course): JsonResponse
    {
        return new JsonResponse($course);
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

    /**
     * Добавить в курс упражнение на основе шаблона упражнения
     */
    #[Route(path: '/{courseId}/exercises/{exerciseId}', methods: ['POST'])]
    #[Entity('course', options: ['id' => 'courseId'])]
    #[Entity('exerciseTemplate', options: ['id' => 'exerciseId'])]
    public function addExerciseFromTemplate(Course $course, ExerciseTemplate $exerciseTemplate): JsonResponse
    {
        $this->courseService->addExerciseFromTemplate($course, $exerciseTemplate);

        return new JsonResponse(null, 204);
    }
}
