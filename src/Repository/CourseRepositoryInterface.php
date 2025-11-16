<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Course;

interface CourseRepositoryInterface
{
    public function save(Course $course): void;
    public function find(string $id): ?Course;
    /** @return Course[] */
    public function all(): array;
    public function delete(string $id): bool;
    public function clear(): void;
}
