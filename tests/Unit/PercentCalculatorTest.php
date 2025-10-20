<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\PercentCalculator;

class PercentCalculatorTest extends TestCase
{
    /** @test */
    public function same_day_returns_at_least_5_percent_if_computed_under_5()
    {
        $start = '2025-05-01';
        $end = '2025-06-30'; // long duration so same-day percent would be < 5
        $entry = '2025-05-01';

        $percent = PercentCalculator::compute($start, $end, $entry, null);
        $this->assertEquals(5.0, $percent);
    }

    /** @test */
    public function normal_midrange_percentage_is_computed_correctly()
    {
        // start -> May1, end -> May10, entry -> May5
        // totalDays = 10, elapsed = 5 => percent = 50.00
        $start = '2025-05-01';
        $end = '2025-05-10';
        $entry = '2025-05-05';

        $percent = PercentCalculator::compute($start, $end, $entry, null);
        $this->assertEquals(50.0, $percent);
    }

    /** @test */
    public function before_start_returns_zero()
    {
        $start = '2025-05-01';
        $end = '2025-05-10';
        $entry = '2025-04-30';

        $percent = PercentCalculator::compute($start, $end, $entry, null);
        $this->assertEquals(0.0, $percent);
    }

    /** @test */
    public function after_end_is_capped_to_100()
    {
        $start = '2025-05-01';
        $end = '2025-05-10';
        $entry = '2025-05-20';

        $percent = PercentCalculator::compute($start, $end, $entry, null);
        $this->assertEquals(100.0, $percent);
    }

    /** @test */
    public function finished_status_returns_100()
    {
        $start = '2025-05-01';
        $end = '2025-06-01';
        $entry = '2025-05-10';

        $percent = PercentCalculator::compute($start, $end, $entry, 'finished');
        $this->assertEquals(100.0, $percent);
    }

    /** @test */
    public function invalid_or_missing_dates_return_zero()
    {
        $percent = PercentCalculator::compute(null, null, null, null);
        $this->assertEquals(0.0, $percent);

        $percent2 = PercentCalculator::compute('invalid-date', '2025-06-01', '2025-05-10');
        $this->assertEquals(0.0, $percent2);
    }

    /** @test */
    public function rounding_is_two_decimal_places()
    {
        // Create a case where percent is not integer: elapsed 2 / total 3 => 66.666... => 66.67
        $start = '2025-05-01';
        $end = '2025-05-03'; // totalDays = 3
        $entry = '2025-05-02'; // elapsed = 2 => 2/3*100 = 66.666...
        $percent = PercentCalculator::compute($start, $end, $entry, null);
        $this->assertEquals(66.67, $percent);
    }
}
