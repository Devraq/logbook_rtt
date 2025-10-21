@extends('logbook.layout')

@section('content')
<h2 class="mb-4">📋 Activity List</h2>

<div class="card p-3">
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th>Kegiatan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Artikel 1</td><td>Tentang User</td><td>01-10-2025</td><td>10-10-2025</td><td><span class="badge bg-success">Selesai</span></td></tr>
                <tr><td>Artikel 2</td><td>Prototipe TKT 4</td><td>11-10-2025</td><td>20-10-2025</td><td><span class="badge bg-warning text-dark">Proses</span></td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection