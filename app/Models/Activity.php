<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'parent_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'assignee_id',
        'weight',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'weight' => 'float',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function parent()
    {
        return $this->belongsTo(Activity::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Activity::class, 'parent_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    /**
     * Compute percent according to rules:
     * - inclusive days (end - start + 1)
     * - elapsed = entry - start + 1
     * - same-day (elapsed == 1) -> minimum 5%
     * - if status == 'finished' -> 100%
     * - clamp 0..100
     *
     * @param string|\DateTime|null $entryDate (YYYY-MM-DD) default: today
     * @return float
     */
    public function computePercent($entryDate = null): float
    {
        if ($this->status && strtolower($this->status) === 'finished') {
            return 100.0;
        }

        if (!$this->start_date || !$this->end_date) {
            return 0.0;
        }

        $start = Carbon::parse($this->start_date)->startOfDay();
        $end = Carbon::parse($this->end_date)->startOfDay();
        $entry = $entryDate ? Carbon::parse($entryDate)->startOfDay() : Carbon::now()->startOfDay();

        // total days inclusive
        $totalDays = max(1, $end->diffInDays($start) + 1);

        // elapsed days relative to start
        $elapsed = $entry->diffInDays($start) + 1;

        if ($elapsed <= 0) {
            return 0.0;
        }

        $percent = ($elapsed / $totalDays) * 100.0;

        // same-day minimum rule
        if ($elapsed === 1 && $percent < 5.0) {
            $percent = 5.0;
        }

        $percent = max(0.0, min(100.0, round($percent, 2)));

        return $percent;
    }
}
