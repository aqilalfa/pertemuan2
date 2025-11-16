<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Repository\InMemoryCourseRepository;
use App\Entity\Course;

final class InMemoryCourseRepositoryTest extends TestCase
{
    public function testSaveAndFind(): void
    {
        $repo = new InMemoryCourseRepository();
        $c = new Course('c1', 'Test Course', 'desc');
        $repo->save($c);
        $found = $repo->find('c1');
        $this->assertNotNull($found);
        $this->assertEquals('Test Course', $found->getName());
    }

    public function testAllAndDelete(): void
    {
        $repo = new InMemoryCourseRepository();
        $repo->save(new Course('a', 'A'));
        $repo->save(new Course('b', 'B'));
        $all = $repo->all();
        $this->assertCount(2, $all);

        $this->assertTrue($repo->delete('a'));
        $this->assertNull($repo->find('a'));
        $this->assertCount(1, $repo->all());
    }

    public function testClear(): void
    {
        $repo = new InMemoryCourseRepository();
        $repo->save(new Course('x', 'X'));
        $repo->clear();
        $this->assertCount(0, $repo->all());
    }
}
