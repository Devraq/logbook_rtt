@extends('logbook.layout')

@section('content')
<h2 class="mb-4">📊 Resume Overview</h2>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h5>Total Modules</h5>
            <h3 class="text-primary fw-bold">4</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h5>Avg Progress</h5>
            <h3 class="text-success fw-bold">56%</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h5>Total Weight</h5>
            <h3 class="text-info fw-bold">89</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h5>Total Hours</h5>
            <h3 class="text-warning fw-bold">430</h3>
        </div>
    </div>
</div>

<div class="card p-3">
    <h5 class="mb-3">Module Summary</h5>
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th>Modul</th>
                    <th>% Complete</th>
                    <th>Bobot</th>
                    <th>Prosentase</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Pembuatan Artikel</td><td>39%</td><td>11</td><td>0.19</td><td>0.07</td></tr>
                <tr><td>Pembuatan Luaran Lain</td><td>20%</td><td>20</td><td>0.35</td><td>0.10</td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
