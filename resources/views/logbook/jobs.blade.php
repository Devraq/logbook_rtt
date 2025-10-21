@extends('logbook.layout')

@section('content')
<h2 class="mb-4">👩‍💻 Job Assignments</h2>

<div class="card p-3">
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Kegiatan</th>
                    <th>Progress</th>
                    <th>Bobot</th>
                    <th>Penanggung Jawab</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>A1</td><td>Artikel User</td><td>40%</td><td>11</td><td>Ayu</td><td>01-10</td><td>10-10</td></tr>
                <tr><td>A2</td><td>Prototipe</td><td>0%</td><td>12</td><td>CC</td><td>11-10</td><td>20-10</td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection