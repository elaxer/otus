<?php

namespace App\Controller\Api\V1;

use App\Entity\Student;
use App\Manager\StudentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/v1/students')]
final class StudentController extends AbstractController
{
    public function __construct(private StudentManager $studentManager) {}

    #[Route(methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $student = new Student($request->request->get('email'));

        $this->studentManager->save($student);

        return new JsonResponse($student, Response::HTTP_CREATED);
    }

    #[Route(path: '/{id}', methods: ['GET'])]
    public function get(Student $student): JsonResponse
    {
        return new JsonResponse($student);
    }

    #[Route(path: '/{id}', methods: ['DELETE'])]
    public function delete(Student $student): JsonResponse
    {
        $this->studentManager->delete($student);

        return new JsonResponse($student);
    }
}
