<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Repository\InMemoryCourseRepository;
use App\Service\CourseService;

final class CourseServiceTest extends TestCase
{
    public function testCreateCourseAndRetrieve(): void
    {
        $repo = new InMemoryCourseRepository();
        $service = new CourseService($repo);

        $course = $service->createCourse('Pemrograman Web', 'Deskripsi');
        $this->assertSame('Pemrograman Web', $course->getName());
        $this->assertNotEmpty($course->getId());

        $found = $service->getCourse($course->getId());
        $this->assertNotNull($found);
        $this->assertEquals($course->getName(), $found->getName());
    }

    public function testCreateEmptyNameThrows(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $repo = new InMemoryCourseRepository();
        $service = new CourseService($repo);
        $service->createCourse('   ');
    }

    public function testListAndDelete(): void
    {
        $repo = new InMemoryCourseRepository();
        $service = new CourseService($repo);
        $a = $service->createCourse('A');
        $b = $service->createCourse('B');

        $list = $service->listCourses();
        $this->assertCount(2, $list);

        $this->assertTrue($service->deleteCourse($a->getId()));
        $this->assertCount(1, $service->listCourses());
    }
}
