<!-- resources/views/logbook/index.blade.php -->
@extends('layouts.admin')

@section('title','Logbook')

@section('content')
<div x-data="logbookApp()" x-init="init()" class="space-y-6">
  <header class="flex items-center justify-between">
    <div>
      <h2 class="text-2xl font-semibold">Project Logbook</h2>
      <p class="text-sm text-gray-500">Daily log, jobs, weights & progress</p>
    </div>
    <div class="space-x-2">
      <button @click="openCreateJob()" class="px-4 py-2 rounded bg-blue-600 text-white">Create Job</button>
      <button @click="openCreateLog()" class="px-4 py-2 rounded bg-green-600 text-white">New Log Entry</button>
    </div>
  </header>

  <!-- Jobs list -->
  <section class="grid grid-cols-3 gap-4">
    <template x-for="job in jobs" :key="job.id">
      <div @click="selectJob(job)" class="p-4 border rounded cursor-pointer"
           :class="selectedJob && selectedJob.id === job.id ? 'ring-2 ring-blue-300' : ''">
        <div class="flex justify-between items-start">
          <div>
            <h3 class="font-semibold" x-text="job.title"></h3>
            <div class="text-xs text-gray-500 mt-1" x-text="job.activity_count + ' activities'"></div>
          </div>
          <div class="text-sm font-medium" x-text="formatPercent(job.latest_progress) + '%'"></div>
        </div>

        <div class="mt-2 text-xs text-gray-600">
          <div x-text="formatDate(job.start_date) + ' → ' + formatDate(job.end_date)"></div>
          <div x-text="'Weight: ' + job.weight"></div>
        </div>
      </div>
    </template>
  </section>

  <!-- Job detail + activities + logbook -->
  <section x-show="selectedJob" class="mt-6">
    <div class="flex items-start justify-between">
      <div>
        <h3 class="text-lg font-bold" x-text="selectedJob.title"></h3>
        <div class="text-sm text-gray-500" x-text="selectedJob.description"></div>
      </div>

      <div class="text-right">
        <div class="text-sm">Assigned: <span x-text="selectedJob.assignees_text"></span></div>
        <div class="mt-2 text-2xl font-semibold" x-text="formatPercent(selectedJob.latest_progress) + '%'"></div>
        <div class="text-xs text-gray-500">Weight share: <span x-text="formatPercent(jobWeightShare(selectedJob)) + '%'"></span></div>
      </div>
    </div>

    <!-- activities -->
    <div class="mt-4">
      <h4 class="font-medium">Activities</h4>
      <ul class="mt-2 space-y-2">
        <template x-for="act in selectedJob.activities" :key="act.id">
          <li class="p-3 border rounded flex justify-between items-center">
            <div>
              <div class="font-medium" x-text="act.title"></div>
              <div class="text-xs text-gray-500" x-text="formatDate(act.start_date) + ' → ' + formatDate(act.end_date)"></div>
            </div>
            <div class="text-sm">
              <div x-text="formatPercent(calculateActivityPercent(act)) + '%'"></div>
              <div class="text-xs text-gray-400" x-text="act.assignee"></div>
            </div>
          </li>
        </template>
      </ul>
    </div>

    <!-- logbook entries -->
    <div class="mt-6">
      <div class="flex items-center justify-between">
        <h4 class="font-medium">Log entries</h4>
        <div class="text-sm text-gray-500" x-text="logEntries.length + ' entries'"></div>
      </div>

      <table class="w-full mt-2 table-auto border-collapse">
        <thead>
          <tr class="text-xs text-left text-gray-600 border-b">
            <th class="py-2">Date</th>
            <th class="py-2">Activity</th>
            <th class="py-2">Percent</th>
            <th class="py-2">Description</th>
            <th class="py-2">Evidence</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="entry in logEntries" :key="entry.id">
            <tr class="border-b">
              <td class="py-2" x-text="formatDate(entry.date)"></td>
              <td class="py-2" x-text="entry.activity_title"></td>
              <td class="py-2" x-text="formatPercent(entry.percent) + '%'"></td>
              <td class="py-2" x-text="entry.description"></td>
              <td class="py-2"><a :href="entry.evidence_url" target="_blank" class="text-blue-600 underline">Link</a></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </section>

  <!-- modals are injected at end of body via templates -->
  @include('logbook._log-entry-modal')
</div>
@endsection
