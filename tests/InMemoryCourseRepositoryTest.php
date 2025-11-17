<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Repository\InMemoryCourseRepository;
use App\Entity\Course;

final class InMemoryCourseRepositoryTest extends TestCase
{
    // Test 1: Apakah save() tidak error?
    public function testSaveWorks(): void
    {
        $repo = new InMemoryCourseRepository();
        $course = new Course('c1', 'Test');
        
        $repo->save($course);
        
        $this->assertTrue(true); // Jika sampai sini berarti save berhasil
    }

    // Test 2: Apakah find() mengembalikan course?
    public function testFindReturnsCourse(): void
    {
        $repo = new InMemoryCourseRepository();
        $repo->save(new Course('c1', 'Test'));
        
        $found = $repo->find('c1');
        
        $this->assertNotNull($found);
    }

    // Test 3: Apakah find() return null jika tidak ada?
    public function testFindReturnsNull(): void
    {
        $repo = new InMemoryCourseRepository();
        
        $result = $repo->find('xxx');
        
        $this->assertNull($result);
    }

    // Test 4: Apakah all() return array?
    public function testAllReturnsArray(): void
    {
        $repo = new InMemoryCourseRepository();
        
        $result = $repo->all();
        
        $this->assertIsArray($result);
    }

    // Test 5: Apakah update() return true?
    public function testUpdateReturnsTrue(): void
    {
        $repo = new InMemoryCourseRepository();
        $repo->save(new Course('c1', 'Old'));
        
        $result = $repo->update(new Course('c1', 'New'));
        
        $this->assertTrue($result);
    }

    // Test 6: Apakah update() return false jika tidak ada?
    public function testUpdateReturnsFalse(): void
    {
        $repo = new InMemoryCourseRepository();
        
        $result = $repo->update(new Course('xxx', 'Test'));
        
        $this->assertFalse($result);
    }

    // Test 7: Apakah delete() return true?
    public function testDeleteReturnsTrue(): void
    {
        $repo = new InMemoryCourseRepository();
        $repo->save(new Course('c1', 'Test'));
        
        $result = $repo->delete('c1');
        
        $this->assertTrue($result);
    }

    // Test 8: Apakah delete() return false jika tidak ada?
    public function testDeleteReturnsFalse(): void
    {
        $repo = new InMemoryCourseRepository();
        
        $result = $repo->delete('xxx');
        
        $this->assertFalse($result);
    }
}
