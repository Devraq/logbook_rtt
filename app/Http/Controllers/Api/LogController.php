<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LogResource;
use App\Models\Job;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index($jobId)
    {
        $logs = Log::where('job_id', $jobId)->get();
        return LogResource::collection($logs);
    }

    public function store(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);

        $validated = $request->validate([
            'activity_id' => 'required|integer',
            'user_id' => 'nullable|integer',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'evidence_url' => 'nullable|url',
            'hours' => 'nullable|numeric',
        ]);

        $log = Log::create([
            'job_id' => $job->id,
            'activity_id' => $validated['activity_id'],
            'user_id' => $validated['user_id'] ?? auth()->id(),
            'date' => $validated['date'],
            'description' => $validated['description'] ?? null,
            'evidence_url' => $validated['evidence_url'] ?? null,
            'hours' => $validated['hours'] ?? null,
            'percent' => 0, // your PercentCalculator logic can be applied here
        ]);

        $jobProgress = Log::where('job_id', $jobId)
            ->orderBy('date', 'desc')
            ->value('percent');

        return response()->json([
            'log' => new LogResource($log),
            'job_progress' => $jobProgress ?? 0,
        ], 201);
    }
}
