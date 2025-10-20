<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'weight',
        'created_by',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'weight' => 'float',
    ];

    // Relations
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function assignees()
    {
        // pivot table job_assignees (job_id, user_id, role) is optional
        return $this->belongsToMany(User::class, 'job_assignees')->withPivot('role')->withTimestamps();
    }
}
