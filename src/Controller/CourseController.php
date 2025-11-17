<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\CourseService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class CourseController
{
    private CourseService $courseService;
    private Twig $view;

    public function __construct(CourseService $courseService, Twig $view)
    {
        $this->courseService = $courseService;
        $this->view = $view;
    }

    public function index(Request $request, Response $response): Response
    {
        $courses = $this->courseService->listCourses();
        return $this->view->render($response, 'courses/index.html.twig', [
            'courses' => $courses,
            'title' => 'All Courses'
        ]);
    }

    public function create(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'courses/create.html.twig', [
            'title' => 'Create New Course'
        ]);
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $name = $data['name'] ?? '';
        $description = $data['description'] ?? null;

        try {
            $this->courseService->createCourse($name, $description);
            return $response
                ->withHeader('Location', '/courses')
                ->withStatus(302);
        } catch (\InvalidArgumentException $e) {
            return $this->view->render($response, 'courses/create.html.twig', [
                'title' => 'Create New Course',
                'error' => $e->getMessage(),
                'old' => $data
            ])->withStatus(400);
        }
    }

    public function show(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $course = $this->courseService->getCourse($id);

        if ($course === null) {
            return $this->view->render($response, 'error.html.twig', [
                'title' => 'Course Not Found',
                'message' => 'The course you are looking for does not exist.'
            ])->withStatus(404);
        }

        return $this->view->render($response, 'courses/show.html.twig', [
            'course' => $course,
            'title' => $course->getName()
        ]);
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $course = $this->courseService->getCourse($id);

        if ($course === null) {
            return $this->view->render($response, 'error.html.twig', [
                'title' => 'Course Not Found',
                'message' => 'The course you are looking for does not exist.'
            ])->withStatus(404);
        }

        return $this->view->render($response, 'courses/edit.html.twig', [
            'course' => $course,
            'title' => 'Edit Course'
        ]);
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $name = $data['name'] ?? '';
        $description = $data['description'] ?? null;

        try {
            $success = $this->courseService->updateCourse($id, $name, $description);
            
            if (!$success) {
                return $this->view->render($response, 'error.html.twig', [
                    'title' => 'Course Not Found',
                    'message' => 'The course you are trying to update does not exist.'
                ])->withStatus(404);
            }

            return $response
                ->withHeader('Location', '/courses/' . $id)
                ->withStatus(302);
        } catch (\InvalidArgumentException $e) {
            $course = $this->courseService->getCourse($id);
            return $this->view->render($response, 'courses/edit.html.twig', [
                'course' => $course,
                'title' => 'Edit Course',
                'error' => $e->getMessage(),
                'old' => $data
            ])->withStatus(400);
        }
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $this->courseService->deleteCourse($id);

        return $response
            ->withHeader('Location', '/courses')
            ->withStatus(302);
    }
}

