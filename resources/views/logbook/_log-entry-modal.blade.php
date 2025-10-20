<!-- resources/views/logbook/_log-entry-modal.blade.php -->
<template id="log-entry-modal-template">
  <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
    <div @click.away="modalOpen=false" class="bg-white rounded-lg w-11/12 max-w-2xl p-6">
      <h3 class="font-semibold text-lg">New Log Entry</h3>
      <div class="mt-4 space-y-3">
        <div>
          <label class="block text-xs">Date</label>
          <input type="date" x-model="form.date" class="w-full border rounded p-2">
        </div>

        <div>
          <label class="block text-xs">Activity</label>
          <select x-model="form.activity_id" class="w-full border rounded p-2">
            <option value="">-- Select activity --</option>
            <template x-for="a in selectedJob.activities" :key="a.id">
              <option :value="a.id" x-text="a.title"></option>
            </template>
          </select>
        </div>

        <div>
          <label class="block text-xs">Hours (optional)</label>
          <input type="number" x-model="form.hours" class="w-full border rounded p-2">
        </div>

        <div>
          <label class="block text-xs">Description</label>
          <textarea x-model="form.description" class="w-full border rounded p-2" rows="3"></textarea>
        </div>

        <div>
          <label class="block text-xs">Evidence link (drive / publication)</label>
          <input type="url" x-model="form.evidence" class="w-full border rounded p-2" placeholder="https://drive.google.com/...">
        </div>

        <div class="flex justify-end gap-2">
          <button @click="modalOpen=false" class="px-4 py-2 rounded border">Cancel</button>
          <button @click="submitLog()" class="px-4 py-2 rounded bg-green-600 text-white">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>
