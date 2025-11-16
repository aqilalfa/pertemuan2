<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Course;

class JsonCourseRepository implements CourseRepositoryInterface
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
        if (!is_file($this->file)) {
            // create empty array file
            file_put_contents($this->file, json_encode([]));
        }
    }

    private function readData(): array
    {
        $raw = file_get_contents($this->file);
        $arr = json_decode($raw, true);
        return is_array($arr) ? $arr : [];
    }

    private function writeData(array $data): void
    {
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function save(Course $course): void
    {
        $data = $this->readData();
        $data[$course->getId()] = $course->toArray();
        $this->writeData($data);
    }

    public function find(string $id): ?Course
    {
        $data = $this->readData();
        if (!isset($data[$id])) {
            return null;
        }
        return Course::fromArray($data[$id]);
    }

    public function all(): array
    {
        $data = $this->readData();
        $result = [];
        foreach ($data as $item) {
            $result[] = Course::fromArray($item);
        }
        return $result;
    }

    public function delete(string $id): bool
    {
        $data = $this->readData();
        if (!isset($data[$id])) {
            return false;
        }
        unset($data[$id]);
        $this->writeData($data);
        return true;
    }

    public function clear(): void
    {
        $this->writeData([]);
    }
}
