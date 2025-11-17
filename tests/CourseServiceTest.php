<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Repository\InMemoryCourseRepository;
use App\Service\CourseService;

final class CourseServiceTest extends TestCase
{
    // Test 1: Apakah createCourse() return Course?
    public function testCreateCourseReturnsCourse(): void
    {
        $service = new CourseService(new InMemoryCourseRepository());
        $course = $service->createCourse('Test');
        
        $this->assertNotNull($course);
    }

    // Test 2: Apakah ID tidak kosong?
    public function testCreateCourseGeneratesId(): void
    {
        $service = new CourseService(new InMemoryCourseRepository());
        $course = $service->createCourse('Test');
        
        $this->assertNotEmpty($course->getId());
    }

    // Test 3: Apakah nama kosong throw exception?
    public function testCreateEmptyNameThrows(): void
    {
        $service = new CourseService(new InMemoryCourseRepository());
        
        $this->expectException(\InvalidArgumentException::class);
        $service->createCourse('   ');
    }

    // Test 4: Apakah updateCourse() return true?
    public function testUpdateReturnsTrue(): void
    {
        $service = new CourseService(new InMemoryCourseRepository());
        $course = $service->createCourse('Old');
        
        $result = $service->updateCourse($course->getId(), 'New', 'Desc');
        
        $this->assertTrue($result);
    }

    // Test 5: Apakah update ID tidak ada return false?
    public function testUpdateNonExistentReturnsFalse(): void
    {
        $service = new CourseService(new InMemoryCourseRepository());
        
        $result = $service->updateCourse('xxx', 'Name', 'Desc');
        
        $this->assertFalse($result);
    }

    // Test 6: Apakah deleteCourse() return true?
    public function testDeleteReturnsTrue(): void
    {
        $service = new CourseService(new InMemoryCourseRepository());
        $course = $service->createCourse('Test');
        
        $result = $service->deleteCourse($course->getId());
        
        $this->assertTrue($result);
    }
}
