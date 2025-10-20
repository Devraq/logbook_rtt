<?php

namespace App\Services;

use Carbon\Carbon;

class PercentCalculator
{
    /**
     * Compute activity percent according to rules:
     * - inclusive total days: (end - start) + 1
     * - elapsed = (entry - start) + 1
     * - if elapsed <= 0 => 0
     * - if elapsed == 1 and percent < 5 => percent = 5
     * - if status == 'finished' => 100
     * - clamp 0..100 and round to 2 decimals
     *
     * @param  string|\DateTime|null  $startDate  (YYYY-MM-DD or DateTime)
     * @param  string|\DateTime|null  $endDate
     * @param  string|\DateTime|null  $entryDate  optional, default now
     * @param  string|null            $status     optional, e.g. 'finished'
     * @return float
     */
    public static function compute($startDate, $endDate, $entryDate = null, ?string $status = null): float
    {
        // finished shortcut
        if ($status !== null && strtolower($status) === 'finished') {
            return 100.0;
        }

        // parse dates safely
        try {
            $start = $startDate ? Carbon::parse($startDate)->startOfDay() : null;
            $end = $endDate ? Carbon::parse($endDate)->startOfDay() : null;
        } catch (\Exception $e) {
            return 0.0;
        }

        if (!$start || !$end) {
            return 0.0;
        }

        $entry = $entryDate ? Carbon::parse($entryDate)->startOfDay() : Carbon::now()->startOfDay();

        // total days inclusive
        $totalDays = max(1, $end->diffInDays($start) + 1);

        // elapsed days relative to start
        $elapsed = $entry->diffInDays($start, false) + 1;

        if ($elapsed <= 0) {
            return 0.0;
        }

        $percent = ($elapsed / $totalDays) * 100.0;

        // same-day minimum rule
        if ($elapsed === 1 && $percent < 5.0) {
            $percent = 5.0;
        }

        // clamp and round
        $percent = max(0.0, min(100.0, (float) round($percent, 2)));

        return $percent;
    }
}
