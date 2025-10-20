// resources/js/logbook.js
import Alpine from 'alpinejs'
window.Alpine = Alpine

Alpine.data('logbookApp', () => ({
  apiBase: '/api', // change if your API base is different
  jobs: [],
  selectedJob: null,
  logEntries: [],
  modalOpen: false,
  form: {
    date: '',
    activity_id: '',
    hours: null,
    description: '',
    evidence: ''
  },

  init() {
    this.fetchJobs()
  },

  async fetchJobs() {
    // GET /api/jobs  -> expects list with activities and assigned users
    try {
      const res = await fetch(this.apiBase + '/jobs')
      if (!res.ok) throw res
      const data = await res.json()
      // example mapping: ensure fields exist
      this.jobs = data.map(j => ({
        ...j,
        latest_progress: j.latest_progress ?? 0,
        activities: j.activities ?? [],
        assignees_text: (j.assignees || []).map(a => a.name).join(', ')
      }))
      // auto-select first job if none
      if (this.jobs.length) this.selectJob(this.jobs[0])
    } catch (err) {
      console.error('Failed to fetch jobs', err)
    }
  },

  async selectJob(job) {
    this.selectedJob = job
    await this.fetchLogEntries(job.id)
  },

  async fetchLogEntries(jobId) {
    try {
      const res = await fetch(`${this.apiBase}/jobs/${jobId}/logs`)
      const data = await res.json()
      // expected: array of {id,date,activity_title,percent,description,evidence_url}
      this.logEntries = data
    } catch (err) {
      console.error(err)
      this.logEntries = []
    }
  },

  openCreateLog() {
    if (!this.selectedJob) { alert('Select a job first'); return }
    this.form = { date: new Date().toISOString().slice(0,10), activity_id: '', hours: null, description: '', evidence: '' }
    this.modalOpen = true
  },

  async submitLog() {
    // compute percent for selected activity and date
    const act = (this.selectedJob.activities || []).find(a => a.id == this.form.activity_id)
    let percent = 0
    if (act) {
      percent = this.calculateActivityPercent(act, this.form.date)
    }

    const payload = {
      date: this.form.date,
      activity_id: this.form.activity_id,
      hours: this.form.hours,
      description: this.form.description,
      evidence_url: this.form.evidence,
      percent: percent
    }

    try {
      const res = await fetch(`${this.apiBase}/jobs/${this.selectedJob.id}/logs`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept':'application/json' },
        body: JSON.stringify(payload)
      })
      if (!res.ok) throw res
      const saved = await res.json()
      this.modalOpen = false
      await this.fetchLogEntries(this.selectedJob.id)
      // refresh jobs/progress
      await this.fetchJobs()
    } catch (err) {
      console.error('Failed to save log', err)
      alert('Failed to save log entry')
    }
  },

  // Calculation helpers
  formatDate(d) {
    if (!d) return ''
    return new Date(d).toLocaleDateString()
  },

  formatPercent(n) {
    if (n === null || n === undefined) return '0'
    return Math.round(n * 100) / 100
  },

  // percent for an activity on a given entry-date
  calculateActivityPercent(activity, entryDate = null) {
    // activity: { start_date, end_date }
    if (!activity || !activity.start_date || !activity.end_date) return 0
    const start = new Date(activity.start_date)
    const end = new Date(activity.end_date)
    const entry = entryDate ? new Date(entryDate) : new Date()

    // If finished flag is set on activity (backend might store), return 100
    if (activity.status && activity.status.toLowerCase() === 'finished') return 100

    // total planned days (inclusive)
    const totalDays = Math.max(1, Math.floor((end - start) / (24*3600*1000)) + 1)
    let elapsed = Math.floor((entry - start) / (24*3600*1000)) + 1
    if (elapsed <= 0) elapsed = 0

    let percent = 0
    if (elapsed === 0) {
      percent = 0
    } else {
      percent = (elapsed / totalDays) * 100
    }

    // same-day rule: if elapsed==1 (same day as start), set minimum 5%
    if (elapsed === 1 && percent < 5) percent = 5

    // clamp 0..100
    if (percent > 100) percent = 100
    if (percent < 0) percent = 0
    return Math.round(percent * 100) / 100
  },

  // job-level percent derived from latest log or aggregated from activities
  jobWeightShare(job) {
    // compute job.weight / sum(all job weights)
    const total = this.jobs.reduce((s, j) => s + (j.weight || 0), 0) || 1
    return ((job.weight || 0) / total) * 100
  },

  // UI helper to format percent for an activity by looking at logs
  calculateActivityPercentFromLogs(activity) {
    const related = this.logEntries.filter(l => l.activity_id === activity.id)
    if (!related.length) return this.calculateActivityPercent(activity)
    // return the latest entry.percent
    const last = related.reduce((a,b)=> new Date(a.date) > new Date(b.date) ? a : b)
    return last.percent ?? this.calculateActivityPercent(activity)
  }
}))

Alpine.start()
