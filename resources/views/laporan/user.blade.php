@extends('laporan.master')

@section('title', 'LAPORAN USER')
@section('nav-title', 'LAPORAN USER')

@section('konten')
    <div class="row mb-3">
        <div class="col-lg-3">
            <a href="{{ route('laporan-user') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-info btn-block font-weight-bold">USER</button></a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('laporan-transaksi') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-secondary btn-block font-weight-bold">TRANSAKSI</button></a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('laporan-fasilitas') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-secondary btn-block font-weight-bold">FASILITAS</button></a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('laporan-event') }}" style="text-decoration: none;"><button
                    class="btn btn-md btn-secondary btn-block font-weight-bold">EVENT</button></a>
        </div>
    </div>

    <table id="tabel-laporan-user" class="table table-bordered table-hover table-sm text-center">
        <thead>
            <tr>
                <th style="width: 5%">ID USER</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection
