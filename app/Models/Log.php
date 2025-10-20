<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'activity_id',
        'user_id',
        'date',
        'hours',
        'percent',
        'description',
        'evidence_url',
    ];

    protected $casts = [
        'date' => 'date',
        'hours' => 'float',
        'percent' => 'float',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
