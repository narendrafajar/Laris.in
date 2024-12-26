<?php

if (!function_exists('formatRupiah')) {
    /**
     * Format angka ke dalam format Rupiah Indonesia.
     *
     * @param int|float $value
     * @param bool $withSymbol
     * @return string
     */
    function formatRupiah($value, $withSymbol = true)
    {
        $formatted = number_format($value, 0, ',', '.');
        return $withSymbol ? 'Rp ' . $formatted : $formatted;
    }
}