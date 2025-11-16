<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\WordCount;

final class WordCountTest extends TestCase
{
    public function testCountWordsValid(): void
    {
        $this->assertEquals(4, WordCount::countWords("My name is Joko"));
    }

    public function testCountWordsOnlySpaces(): void
    {
        $this->assertEquals(0, WordCount::countWords("    "));
    }

    public function testCountWordsEmpty(): void
    {
        $this->assertEquals(0, WordCount::countWords(""));
    }

    public function testCountWordsNull(): void
    {
        $this->assertEquals(0, WordCount::countWords(null));
    }
}
