<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Course;
use App\Repository\CourseRepositoryInterface;
use InvalidArgumentException;

class CourseService
{
    private CourseRepositoryInterface $repo;

    public function __construct(CourseRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function createCourse(string $name, ?string $description = null): Course
    {
        $name = trim($name);
        if ($name === '') {
            throw new InvalidArgumentException('Course name cannot be empty');
        }

        $id = $this->slugify($name) . '-' . bin2hex(random_bytes(4));
        $course = new Course($id, $name, $description);
        $this->repo->save($course);
        return $course;
    }

    public function getCourse(string $id): ?Course
    {
        return $this->repo->find($id);
    }

    /** @return Course[] */
    public function listCourses(): array
    {
        return $this->repo->all();
    }

    public function deleteCourse(string $id): bool
    {
        return $this->repo->delete($id);
    }

    private function slugify(string $text): string
    {
        $text = mb_strtolower($text, 'UTF-8');
        $text = preg_replace('/[^\p{L}\p{N}\s-]+/u', '', $text);
        $text = preg_replace('/[\s-]+/', '-', trim($text));
        return $text === '' ? 'course' : $text;
    }
}
