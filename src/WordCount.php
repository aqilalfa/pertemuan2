<?php
declare(strict_types=1);

namespace App;

/**
 * Class WordCount
 * Utility sederhana untuk menghitung jumlah kata dalam sebuah string.
 */
class WordCount
{
    /**
     * Hitung jumlah kata pada teks.
     *
     * - Mengabaikan whitespace berlebih.
     * - Jika string kosong atau hanya whitespace, kembalikan 0.
     *
     * @param string|null $text
     * @return int
     */
    public static function countWords(?string $text): int
    {
        if ($text === null) {
            return 0;
        }

        // Trim dan pisah berdasarkan whitespace (spasi, tab, newline)
        $trimmed = trim($text);
        if ($trimmed === '') {
            return 0;
        }

        // Pecah pada satu atau lebih whitespace
        $parts = preg_split('/\s+/u', $trimmed, -1, PREG_SPLIT_NO_EMPTY);
        return $parts === false ? 0 : count($parts);
    }
}
