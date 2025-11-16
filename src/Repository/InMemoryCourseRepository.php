<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Course;

class InMemoryCourseRepository implements CourseRepositoryInterface
{
    /** @var array<string, array> */
    private array $store = [];

    public function save(Course $course): void
    {
        $this->store[$course->getId()] = $course->toArray();
    }

    public function find(string $id): ?Course
    {
        return isset($this->store[$id]) ? Course::fromArray($this->store[$id]) : null;
    }

    public function all(): array
    {
        $result = [];
        foreach ($this->store as $item) {
            $result[] = Course::fromArray($item);
        }
        return $result;
    }

    public function delete(string $id): bool
    {
        if (!isset($this->store[$id])) {
            return false;
        }
        unset($this->store[$id]);
        return true;
    }

    public function clear(): void
    {
        $this->store = [];
    }
}
