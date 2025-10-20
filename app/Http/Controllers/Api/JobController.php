<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JobResource;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with(['activities', 'assignees'])->get();
        return JobResource::collection($jobs);
    }

    public function show(Job $job)
    {
        $job->load(['activities', 'assignees']);
        return new JobResource($job);
    }
}
