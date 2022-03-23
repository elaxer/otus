<?php

namespace App\Controller;

use App\Entity\Student;
use App\Manager\StudentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/students')]
final class StudentController extends AbstractController
{
    public function __construct(private StudentManager $studentManager) {}

    #[Route(methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $student = new Student($request->request->get('email'));

        $this->studentManager->save($student);

        return new JsonResponse($student, 201);
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
