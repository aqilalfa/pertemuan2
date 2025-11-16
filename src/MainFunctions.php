<?php
declare(strict_types=1);

namespace App;

use DateTimeImmutable;
use Exception;

/**
 * Class MainFunctions
 * Kumpulan fungsi utilitas sederhana yang akan diuji.
 */
class MainFunctions
{
    /**
     * Konversi kilometer ke miles (pembulatan 1 desimal).
     *
     * @param mixed $km
     * @return float|string  returns float jika input valid, string error jika tidak valid
     */
    public static function kilometers_to_miles($km)
    {
        if (!is_numeric($km)) {
            return "Input tidak valid";
        }

        $miles = (float)$km * 0.621371;
        // Pembulatan 1 desimal seperti pada contoh
        return round($miles, 1);
    }

    /**
     * Kembalikan tanggal 'besok' dalam format YYYY-MM-DD.
     *
     * @param string|null $baseDate optional, format 'Y-m-d' atau null untuk hari ini
     * @return string
     */
    public static function tomorrow(?string $baseDate = null): string
    {
        try {
            $dt = $baseDate === null ? new DateTimeImmutable('now') : new DateTimeImmutable($baseDate);
            $tomorrow = $dt->modify('+1 day');
            return $tomorrow->format('Y-m-d');
        } catch (Exception $e) {
            // Jika format tanggal baseDate salah, kembalikan string error
            return "Invalid date";
        }
    }

    /**
     * Hash SHA-256 dari sebuah string.
     *
     * @param string $input
     * @return string
     */
    public static function sha256_digest(string $input): string
    {
        return hash('sha256', $input);
    }

    /**
     * Hash MD5 dari sebuah string.
     *
     * @param string $input
     * @return string
     */
    public static function md5_digest(string $input): string
    {
        return md5($input);
    }
}
