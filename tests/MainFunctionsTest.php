<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\MainFunctions;

final class MainFunctionsTest extends TestCase
{
    public function testKilometersToMilesValid(): void
    {
        // 10 km -> 6.21371 -> dibulatkan 1 desimal => 6.2
        $this->assertEquals(6.2, MainFunctions::kilometers_to_miles(10));
    }

    public function testKilometersToMilesInvalid(): void
    {
        $this->assertEquals("Input tidak valid", MainFunctions::kilometers_to_miles("sepuluh"));
    }

    public function testTomorrowDefault(): void
    {
        $today = new DateTimeImmutable('now');
        $expected = $today->modify('+1 day')->format('Y-m-d');
        $this->assertEquals($expected, MainFunctions::tomorrow());
    }

    public function testTomorrowWithBaseDate(): void
    {
        $this->assertEquals('2025-11-14', MainFunctions::tomorrow('2025-11-13'));
    }

    public function testSha256Digest(): void
    {
        $this->assertEquals(hash('sha256', 'abc'), MainFunctions::sha256_digest('abc'));
    }

    public function testMd5Digest(): void
    {
        $this->assertEquals(md5('abc'), MainFunctions::md5_digest('abc'));
    }
}
