@extends('logbook.layout')

@section('content')
<h2 class="mb-4">🗓️ Daily Logbook</h2>

<div class="card p-3 mb-4">
    <h5>Tambah Catatan</h5>
    <form class="row g-3">
        <div class="col-md-3"><input type="date" class="form-control" placeholder="Tanggal"></div>
        <div class="col-md-3"><input type="text" class="form-control" placeholder="Job"></div>
        <div class="col-md-2"><input type="number" class="form-control" placeholder="%"></div>
        <div class="col-md-2"><input type="number" class="form-control" placeholder="Durasi (menit)"></div>
        <div class="col-md-2"><input type="text" class="form-control" placeholder="Keterangan"></div>
        <div class="col-12 text-end"><button type="submit" class="btn btn-primary">Tambah</button></div>
    </form>
</div>

<div class="card p-3">
    <h5 class="mb-3">Riwayat Aktivitas</h5>
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Job</th>
                    <th>Progress</th>
                    <th>Durasi</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>2025-10-20</td><td>Artikel 1</td><td>20%</td><td>90</td><td>Review draft</td></tr>
                <tr><td>2025-10-21</td><td>Prototipe</td><td>10%</td><td>120</td><td>UI updates</td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection